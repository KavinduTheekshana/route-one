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
        $services = Services::orderBy('created_at', 'desc')
            ->get();
        return view('backend.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.services.create');
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
            'description' => 'nullable|string'
        ]);

        // Create a new Service record
        Services::create([
            'user_id' => Auth::id(),
            'service_name' => $validatedData['service_name'],
            'price' => $validatedData['price'],
            'currency' => $validatedData['currency'],
            'description' => $validatedData['description']
        ]);

        // Redirect back or to another route with a success message
        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $service = Services::findOrFail($id);
        return view('backend.services.create', compact('service')); // Adjust view name as needed
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'currency' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $service = Services::findOrFail($id);
        $service->update($request->all());

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully!');
    }



    public function toggleStatus(Services $service)
    {
        $service->status = !$service->status; // Toggles between 1 and 0
        $service->save();

        return redirect()->back()->with('success', 'Service status updated.');
    }



    public function destroy(Services $service)
    {
        $service->delete();
        return redirect()->back()->with('success', 'Service deleted successfully!');
    }
}
