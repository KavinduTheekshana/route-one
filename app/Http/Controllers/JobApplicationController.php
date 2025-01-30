<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobApplication;
use App\Models\Message;
use App\Models\Payslips;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{

    public function assignPosition(Request $request)
    {
        $request->validate([
            'vacancy_id' => 'required|exists:vacancies,id',
            'user_id' => 'required|exists:users,id',
        ]);

        JobApplication::create([
            'vacancies_id' => $request->vacancy_id,
            'user_id' => $request->user_id,
        ]);

        return response()->json(['success' => true]);
    }

    public function message()
    {

        $user = auth()->user();
        $agent = Application::where('user_id', $user->id)->value('agent_id');

        if (!$agent) {
            return redirect()->back()->with('error', 'No agent assigned to you yet. Please Fill Application and select an agent');
        } else {
            $agent_name = User::where('id', $agent)->value('name');

            $messages = Message::where('sender_id', Auth::id())
                ->orWhere('receiver_id', Auth::id())
                ->with('sender', 'receiver')
                ->orderBy('created_at', 'asc')
                ->get();

            return view('frontend.auth.dashboard.message', compact('messages', 'agent', 'agent_name'));
        }
    }

    public function payslips()
    {

        $userid = auth()->id();
        $user = User::findOrFail($userid);
        $payslips = Payslips::where('user_id', $userid)->get();
        return view('frontend.auth.dashboard.payslips', compact('user', 'payslips'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'receiver_id' => 'required|string',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id, // Pass this as hidden input or default it for single chat
            'message' => $request->message,
        ]);

        return back();
    }


    public function positions()
    {
        $user = auth()->user();

        // Fetch the jobs that the user has applied for
        $vacancies = JobApplication::where('user_id', $user->id)
            ->with('job') // Assuming you have a relationship defined
            ->get();
        return view('frontend.auth.dashboard.positions', compact('vacancies'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'job_id' => 'required', // Ensure job_id exists in jobs table
            ]);
            // Check if user has completed profile
            $user = auth()->user();
            if (!$user->country || !$user->phone) {
                return response()->json(['status' => 'error', 'message' => 'Please complete your profile before applying.']);
            }

            // Create the job application
            JobApplication::create([
                'vacancies_id' => $request->input('job_id'),
                'user_id' => $user->id,
            ]);

            return response()->json(['status' => 'success', 'message' => 'Job application submitted successfully!']);
        } catch (\Exception $e) {
            \Log::error('Error applying for job: ' . $e->getMessage()); // Log the error for debugging
            return response()->json(['status' => 'error', 'message' => 'Something went wrong! Please try again later.']);
        }
    }

    public function destroy($id)
    {

        $application = JobApplication::findOrFail($id);

        // Ensure the authenticated user is the owner of the application
        if ($application->user_id !== auth()->id()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized action.'], 403);
        }

        // Delete the application
        $application->delete();

        return response()->json(['status' => 'success', 'message' => 'Application deleted successfully.']);
    }
}
