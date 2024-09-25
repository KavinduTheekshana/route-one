<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->user_type === 'user') {
            return view('frontend.auth.dashboard.profile');
        } else {
            return view('backend.index');
        }
    }

    public function account()
    {

            return view('backend.account.settings');

    }
}
