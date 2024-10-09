<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\Testimonial;
use App\Models\Vacancies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.home.index', compact('testimonials'));
    }
    public function about()
    {
        $testimonials = Testimonial::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('frontend.about.index', compact('testimonials'));
    }
    public function contact()
    {
        return view('frontend.contact.index');
    }
    public function jobs()
    {
        // Get the currently authenticated user
        $user = auth()->user();

        // Create an array to store applied job IDs if the user is authenticated
        $appliedJobIds = [];
        if ($user) {
            $appliedJobIds = JobApplication::where('user_id', $user->id)
                ->pluck('vacancies_id')
                ->toArray();
        }

        // Get all vacancies with status 1
        $vacancies = Vacancies::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        // Return the jobs index view with vacancies and applied job IDs
        return view('frontend.jobs.index', compact('vacancies', 'appliedJobIds'));
    }
    public function vacancy($id)
    {
        // Fetch the vacancy by ID
        $vacancy = Vacancies::findOrFail($id);

        // Get the currently authenticated user
        $user = auth()->user();

        // Initialize $hasApplied to false by default
        $hasApplied = false;

        // Check if the user is authenticated and has applied for the vacancy
        if ($user) {
            $hasApplied = JobApplication::where('vacancies_id', $vacancy->id)
                ->where('user_id', $user->id)
                ->exists();
        }

        // Pass the vacancy data and application status to the view
        return view('frontend.jobs.single', compact('vacancy', 'hasApplied'));
    }


    public function services()
    {
        return view('frontend.services.index');
    }
    public function login()
    {
        return view('frontend.auth.login');
    }
    public function register()
    {
        return view('frontend.auth.register');
    }
    public function forgot()
    {
        return view('frontend.auth.forgot');
    }
}
