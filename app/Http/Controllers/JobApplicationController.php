<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
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
