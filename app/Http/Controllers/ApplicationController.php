<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function application()
    {
        $application = Application::where('user_id', auth()->id())->first();
        $agents = User::where('user_type', 'agent')->get();
        return view('frontend.auth.dashboard.application', compact('agents', 'application'));
    }

    public function documents()
    {
        $userid = auth()->id();
        $user = User::findOrFail($userid);
        $documents = Document::where('user_id', $userid)->get();
        return view('frontend.auth.dashboard.documents', compact('user', 'documents'));
    }


    public function store(Request $request)
    {
        // Find the current application if it exists
        $application = Application::where('user_id', auth()->id())->first();

        $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'email' => [
                'required',
                'email',
                'unique:applications,email,' . ($application->id ?? 'NULL'), // Ignore the current application's email
            ],
            'address' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'passport' => 'nullable|string|max:50',
            'agent' => 'nullable|exists:users,id',
        ]);

        // Create or update the application record
        Application::updateOrCreate(
            ['user_id' => auth()->id()], // Condition to find the existing application
            $request->all() + ['user_id' => auth()->id()] // Fill data
        );

        return redirect()->route('user.application')->with('success', 'Application saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        //
    }
}
