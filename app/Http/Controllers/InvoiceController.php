<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Mail\SendPdfMail;
use App\Models\Application;
use App\Models\Invoice;
use App\Models\InvoiceService;
use App\Models\Services;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{

    public function sendPdf(Request $request)
    {
        $request->validate([
            'pdf' => 'required|string',
            'subject' => 'required|string',
            'receiver' => 'required|string|email',
            'message' => 'required|string',
        ]);

        $pdfData = $request->input('pdf');
        $subjectLine = $request->input('subject');
        $recipientEmail = $request->input('receiver');
        $emailMessage = $request->input('message');


        // Decode the PDF from the base64 string
        $decodedPdf = base64_decode($pdfData);

        // Use Laravel's Mailable feature to send the PDF as an attachment
        try {
            Mail::to($recipientEmail)->send(new SendPdfMail($pdfData, $subjectLine, $emailMessage));
            return response()->json(['message' => 'Invoice sent successfully']);
        } catch (\Exception $e) {
            // Handle the error
            return response()->json(['message' => 'Failed to send Invoice', 'error' => $e->getMessage()], 500);
        }
    }



    public function index()
    {
        // Get the authenticated user ID
        $user_id = Auth::user()->id;
        $invoices = Invoice::with(['customer', 'services'])->where('user_id',$user_id)->orderBy('created_at', 'desc')->get();

        return view('backend.invoice.list', compact('invoices'));
    }

    public function view($id)
    {
        // Retrieve the invoice along with customer and services
        $invoice = Invoice::with(['customer', 'services'])->findOrFail($id);

        return view('backend.invoice.view', compact('invoice'));
    }


    public function search(Request $request)
    {
        $query = $request->input('q');
        $users = Application::where('name', 'LIKE', "%$query%")
            ->select('id', 'user_id', 'name', 'email', 'address')
            ->get();

        $results = $users->map(function ($user) {
            return [
                'user_id' => $user->user_id,
                'id' => $user->id,
                'name' => $user->name, // This will be the display name
                'email' => $user->email, // This will be the display name
                'address' => $user->address, // Add the address here
            ];
        });

        return response()->json($results);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Services::where('status', 1)->get();
        // Get the last invoice record
        $lastInvoice = Invoice::latest('id')->first();

        // Generate the next invoice number
        $nextInvoiceNumber = $lastInvoice ? $lastInvoice->invoice_number + 1 : 1;

        // Pad the invoice number to 5 digits
        $formattedInvoiceNumber = str_pad($nextInvoiceNumber, 5, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now()->format('d/m/Y');

        return view('backend.invoice.index', compact('services', 'formattedInvoiceNumber', 'currentDate'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'invoice_number' => 'required|unique:invoices,invoice_number',
            'customer_id' => 'required|exists:users,id',
            'service_name' => 'required|array',
            'service_name.*' => 'required|string',
            'description' => 'nullable|array',
            'description.*' => 'nullable|string',
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1',
            'price' => 'required|array',
            'price.*' => 'required|numeric|min:0',
            'total' => 'required|array',
            'total.*' => 'required|numeric|min:0',
            'total_fee' => 'required',
            'date' => 'nullable|date', // Optional date field
            'note' => 'nullable',
            'tax_rate'=>'required' // Optional date field
        ]);

        $currentDate = Carbon::now()->format('d/m/Y');
        $formattedDate = Carbon::createFromFormat('Y-m-d', $request->date)->format('d/m/Y');

        $date = $formattedDate ?? $currentDate;
        dd($date);

        // Create the invoice
        $invoice = Invoice::create([
            'invoice_number' => $request->invoice_number,
            'customer_id' => $request->customer_id,
            'user_id' => Auth::id(),
            'subtotal' => $request->subtotal,
            'tax' => $request->tax,
            'total_fee' => $request->total_fee,
            'date' => $date, // Use the $date variable
            'note' => $request->note, // Use the $date variable
            'tax_rate' => $request->tax_rate, // Use the $date variable
        ]);

        // Create the associated invoice services
        foreach ($request->service_name as $index => $serviceName) {
            InvoiceService::create([
                'invoice_id' => $invoice->id,
                'service_name' => $serviceName,
                'description' => $request->description[$index],
                'qty' => $request->quantity[$index],
                'price' => $request->price[$index],
                'total' => $request->total[$index],
            ]);
        }
        return redirect()->route('admin.invoice.view', $invoice->id)
        ->with('success', 'Invoice saved successfully.');
        // return redirect()->back()->with('success', 'Invoice and services saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->back()->with('success', 'Invoice deleted successfully!');
    }
}
