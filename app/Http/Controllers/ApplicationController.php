<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationApproved;
use App\Models\Application;
use App\Models\Document;
use App\Models\JobApplication;
use App\Models\User;
use App\Models\UserNotes;
use App\Models\Vacancies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewMessageNotification;
use Illuminate\Support\Facades\Log;
use NotifyLk\Api\SmsApi;

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

        // Update the agent_id in the users table
        if ($request->filled('agent')) {
            $user = auth()->user(); // Get the authenticated user
            $user->agent_id = $request->agent; // Set the agent_id
            $user->save(); // Save the user record
        }

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

        if ($request->filled('agent')) {
            $user = User::find($request->user_id); // Get the user by user_id from the request
            if ($user) {
                $user->agent_id = $request->agent; // Set the agent_id
                $user->save(); // Save the user record
            }
        }

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
        // Mail::raw('This is a test email', function ($message) {
        //     $message->to('kavindutheekshana@gmail.com')->subject('Test Email');
        // });
        // Mail::to($application->email)->send(new ApplicationApproved($application->name));

        Mail::to($application->email)->send(new ApplicationApproved($application->name));

        $phone = $application->phone;

        if (str_starts_with($phone, '0') && strlen($phone) === 10) {
            $phone = '94' . substr($phone, 1);
            // Send SMS notification to the receiver
            $this->sendTextMessage($phone, $application->name);
        } elseif (str_starts_with($phone, '+94') && strlen($phone) === 12) {
            $phone = substr($phone, 1);
            $this->sendTextMessage($phone, $application->name);
        }



        // Redirect back with a success message
        return redirect()->back()->with([
            'success' => 'Application approved successfully.',
            'showApplicationTab' => true // Pass data to trigger the application tab
        ]);
    }

    private function sendTextMessage($phone, $name)
    {
        $api_instance = new SmsApi();
        $user_id = "25086";
        $api_key = "bxw9mVd8JJRz2nVFR1bR";
        $message = "Dear " . $name . ", \n\nWe are pleased to inform you that your application has been successfully approved.\n\nBest Regards,\nRoute One Recruitment";
        // $message = "Your Verification Code is: " . $storedOtp . "\n\nThanks for voting with us!\nIf you didn't request an OTP, click here.\nhttps://bit.ly/3Z3gBZ2";
        $to = $phone;
        $sender_id = "ROUTE ONE";
        try {
            $api_instance->sendSMS($user_id, $api_key, $message, $to, $sender_id);
            // return redirect()->route('vote')->with('status', 'SMS sent successfully');
        } catch (\Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage(), ['exception' => $e]);
            echo ($e->getMessage());
            return redirect()->route('vote')->with('exception', 'Something went wrong');
        }
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
        $agent = User::where('id', $user->agent_id)->first();
        $notes = UserNotes::with('admin')->where('user_id', $id)->get();
        // dd($user->agent_id);

        $vacancies = JobApplication::where('user_id', $user->id)
            ->with('job') // Assuming you have a relationship defined
            ->get();

        $jobs = Vacancies::get();

        // Flash the session variable to indicate the application tab should be shown
        session()->flash('showApplicationTab', true);

        return view('backend.user.settings.settings', compact('user', 'documents', 'application', 'agents', 'vacancies', 'jobs', 'agent', 'notes'));
    }
}
