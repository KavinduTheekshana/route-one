<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.services.index');
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
        // Validate the request data
        $validatedData = $request->validate([
            'service_name' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'currency' => 'required|string|max:3',
            'review' => 'nullable|string'
        ]);

        // Create a new Service record
        Services::create([
            'user_id' => Auth::id(),
            'service_name' => $validatedData['service_name'],
            'price' => $validatedData['price'],
            'currency' => $validatedData['currency'],
            'description' => $validatedData['review']
        ]);

        // Redirect back or to another route with a success message
        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Services $services)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Services $services)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Services $services)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Services $services)
    {
        //
    }
}
