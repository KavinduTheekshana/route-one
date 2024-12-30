<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Document;
use App\Models\User;
use App\Models\Vacancies;
use Carbon\Carbon;
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
        }
        // elseif (Auth::user()->user_type === 'agent' && Auth::user()->agent_verification === 0) {
        //     dd('Agent status 0');
        // }
         else {
            $userCount = User::where('user_type', 'user')->count();
            $agentCount = User::where('user_type', 'agent')->count();
            $activeVacancies = Vacancies::where('status', '1')->count();
            $approvedApplications = Application::count();
            $users = User::where('user_type', 'user')
                ->whereBetween('created_at', [Carbon::now()->startOfDay()->subDays(2), Carbon::now()->endOfDay()])
                ->orderBy('id', 'desc')
                ->get();
            $applications = Application::with(['user', 'certificate', 'agent', 'vacancies'])
                ->whereBetween('updated_at', [Carbon::now()->startOfDay()->subDays(2), Carbon::now()->endOfDay()])
                ->orderBy('updated_at', 'desc')
                ->get();
            $recentDocuments = Document::with('user') // Include user details
                ->where('updated_at', '>=', Carbon::now()->subDays(3))
                ->orderBy('updated_at', 'desc')
                ->get();

            return view('backend.index', compact('userCount', 'agentCount', 'activeVacancies', 'approvedApplications', 'users', 'applications', 'recentDocuments'));
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
