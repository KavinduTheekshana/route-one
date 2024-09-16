<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->user_type === 'user') {
            // Separate dashboard for 'user' role
            return view('frontend.user.dashboard');
        } else {
            return view('backend.dashboard.index');
        }
    }

    public function account()
    {

            return view('backend.dashboard.account.settings');

    }
}
