<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use App\Models\Vacancies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->user_type === 'user') {
            // $response = Http::get('https://restcountries.com/v3.1/all');
            // $countries = $response->json();
            return view('frontend.auth.dashboard.profile');
        } else {
            $userCount = User::where('user_type', 'user')->count();
            $agentCount = User::where('user_type', 'agent')->count();
            $activeVacancies = Vacancies::where('status', '1')->count();
            $approvedApplications = Application::count();
            return view('backend.index', compact('userCount', 'agentCount', 'activeVacancies', 'approvedApplications'));
        }
    }

    public function getMonthlyData()
    {
        // Get monthly registration counts for users
        $userRegistrations = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Get monthly application counts
        $applications = Application::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Format data for each month, from January to December
        $months = range(1, 12);
        $registrationsData = [];
        $applicationsData = [];

        foreach ($months as $month) {
            $registrationsData[] = $userRegistrations[$month] ?? 0;
            $applicationsData[] = $applications[$month] ?? 0;
        }

        // Pass data to the view or as JSON for the frontend
        return response()->json([
            'registrations' => $registrationsData,
            'applications' => $applicationsData,
        ]);
    }

    public function account()
    {

        return view('backend.account.settings');
    }
}
