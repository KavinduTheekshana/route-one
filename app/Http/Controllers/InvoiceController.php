<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Invoice;
use App\Models\Services;
use App\Models\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function index()
    {
        $services = Services::where('status', 1)->get();
        return view('backend.invoice.index',compact('services'));
    }


    public function search(Request $request)
    {
        $query = $request->input('q');
        $users = Application::where('name', 'LIKE', "%$query%")
            ->select('id', 'name', 'address')
            ->get();

        $results = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name, // This will be the display name
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
