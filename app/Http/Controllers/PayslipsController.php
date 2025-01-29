<?php

namespace App\Http\Controllers;

use App\Models\Payslips;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PayslipsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'file_name' => 'required|date',
            'file' => 'required|mimes:jpg,jpeg,png,webp,pdf|max:10240', // 10MB max
        ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileOriginalName = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            // $fileType = $file->getClientOriginalExtension();
            $fileType = $file->getMimeType(); // Get MIME type
            $filePath = $file->store('payslips', 'public'); // Stored in storage/app/public/payslips

            // Save to database
            Payslips::create([
                'user_id' => $request->user_id,
                'date' => $request->file_name, // Assuming this is the payslip date
                'file_size' => $fileSize,
                'file_type' => $fileType,
                'file_path' => $filePath,
                'file_original_name' => $fileOriginalName,
            ]);

            return redirect()->back()->with('success', 'Payslip uploaded successfully.');
        }

        return redirect()->back()->with('error', 'File upload failed.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payslips $payslips)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payslips $payslips)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payslips $payslips)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payslips $payslip)
    {
        Storage::delete($payslip->file_path);
        $payslip->delete();

        return redirect()->back()->with('success', 'Payslip deleted successfully!');
    }
}
