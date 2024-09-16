<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // public function index()
    // {
    //     if (Auth::user()->user_type === 'user') {
    //         return view('frontend.user.dashboard');
    //     } elseif (Auth::user()->user_type === 'superadmin') {
    //         return view('backend.superadmin.dashboard');
    //     }elseif (Auth::user()->user_type === 'admin') {
    //         return view('backend.admin.dashboard');
    //     }elseif (Auth::user()->user_type === 'teacher') {
    //         return view('backend.teacher.dashboard');
    //     }else{
    //         return view('/');
    //     }
    // }




    public function sample()
    {
        return view('frontend.sample');
    }
}
