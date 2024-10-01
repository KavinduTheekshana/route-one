<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\Vacancies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home.index');
    }
    public function about()
    {
        return view('frontend.about.index');
    }
    public function contact()
    {
        return view('frontend.contact.index');
    }
    public function jobs()
    {
        $user = auth()->user();

        // Create an array to store applied job IDs
        $appliedJobIds = JobApplication::where('user_id', $user->id)
            ->pluck('vacancies_id')
            ->toArray();
        $vacancies = Vacancies::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.jobs.index', compact('vacancies','appliedJobIds'));
    }
    public function vacancy($id)
    {
        $vacancy = Vacancies::findOrFail($id); // Fetch the vacancy by ID
        $user = auth()->user();
        $hasApplied = JobApplication::where('vacancies_id', $vacancy->id)
            ->where('user_id', $user->id)
            ->exists();
        return view('frontend.jobs.single', compact('vacancy', 'hasApplied')); // Pass the vacancy data to the view
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
}
