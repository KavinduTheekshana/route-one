<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Document;
use App\Models\JobApplication;
use App\Models\User;
use App\Models\Vacancies;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function application()
    {
        $application = Application::where('user_id', auth()->id())->first();
        $agents = User::where('user_type', 'agent')->where('status', 1)->get();
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

    public function update(Request $request)
    {
        // Get user_id from the form
        $userId = $request->user_id;

        // Find the current application based on the user_id from the form
        $application = Application::where('user_id', $userId)->firstOrFail();

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'email' => [
                'required',
                'email',
                'unique:applications,email,' . $application->id, // Ignore the current application's email
            ],
            'address' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'passport' => 'nullable|string|max:50',
            'agent' => 'nullable|exists:users,id',
        ]);

        // Update the application with the validated data
        $application->update($request->all());

        return redirect()->back()->with([
            'success' => 'Application updated successfully.',
            'showApplicationTab' => true // Pass data to trigger the application tab
        ]);
    }

    public function approve($id)
    {
        // Find the application by its ID
        $application = Application::findOrFail($id);

        // Update the status to 1 (approved)
        $application->update(['status' => 1]);

        // Redirect back with a success message
        return redirect()->back()->with([
            'success' => 'Application approved successfully.',
            'showApplicationTab' => true // Pass data to trigger the application tab
        ]);
    }

    public function reject($id)
    {
        // Find the application by its ID
        $application = Application::findOrFail($id);

        // Update the status to 2 (or any value representing rejected)
        $application->update(['status' => 0]);

        // Redirect back with a success message
        return redirect()->back()->with([
            'success' => 'Application rejected successfully.',
            'showApplicationTab' => true // Pass data to trigger the application tab
        ]);
    }
    public function show($id)
    {
        // Find the application by its ID
        $application = Application::findOrFail($id);

        // Return the application details as JSON
        return response()->json($application);
    }


    public function applications()
    {
        $applications = Application::orderBy('created_at', 'desc')
            ->get();

        return view('backend.applications.index', compact('applications'));
    }
    public function user_settings_application($id)
    {
        $user = User::findOrFail($id);
        $documents = Document::where('user_id', $id)->get();
        $application = Application::where('user_id', $id)->first();
        $agents = User::where('user_type', 'agent')->get();

        $vacancies = JobApplication::where('user_id', $user->id)
            ->with('job') // Assuming you have a relationship defined
            ->get();

        $jobs = Vacancies::get();

        // Flash the session variable to indicate the application tab should be shown
        session()->flash('showApplicationTab', true);

        return view('backend.user.settings.settings', compact('user', 'documents', 'application', 'agents','vacancies','jobs'));
    }
}
