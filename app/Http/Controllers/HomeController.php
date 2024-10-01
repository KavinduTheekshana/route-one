<?php

namespace App\Http\Controllers;

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
        $vacancies = Vacancies::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.jobs.index', compact('vacancies'));
    }
    public function vacancy($id)
    {
        $vacancies = Vacancies::where('status', 1)
            ->where('id', '!=', $id) // Exclude the current vacancy by its ID
            ->orderBy('created_at', 'desc')
            ->take(2) // Limit to 3 vacancies
            ->get();
        $vacancy = Vacancies::findOrFail($id); // Fetch the vacancy by ID
        return view('frontend.jobs.single', compact('vacancy', 'vacancies')); // Pass the vacancy data to the view
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
