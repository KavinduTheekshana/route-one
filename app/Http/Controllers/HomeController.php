<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Vacancies;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;

class HomeController extends Controller
{

    public function generateSlugs()
    {
        // Fetch all vacancies without a slug
        $vacancies = Vacancies::whereNull('slug')->get();

        foreach ($vacancies as $vacancy) {
            $slug = Str::slug($vacancy->title);

            // Ensure the slug is unique
            $existingSlugCount = Vacancies::where('slug', 'like', $slug . '%')->count();
            if ($existingSlugCount > 0) {
                $slug .= '-' . ($existingSlugCount + 1);
            }

            // Update the vacancy
            $vacancy->slug = $slug;
            $vacancy->save();
        }

        return response()->json([
            'message' => 'Slugs generated successfully!',
            'count' => $vacancies->count()
        ]);
    }

    public function reset(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'token' => 'required', // Validate that the token is also present
        ]);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'We can\'t find a user with that email address.']);
        }

        // Check if the token matches the remember_token in the database
        if ($user->remember_token !== $request->token) {
            return back()->withErrors(['token' => 'Invalid or expired password reset token.']);
        }

        $tokenExpiry = now()->subMinutes(15);
        if ($user->updated_at < $tokenExpiry) {
            return back()->withErrors(['email' => 'This password reset link has expired.']);
        }

        // Update the password and clear the token
        $user->password = Hash::make($request->password);
        $user->remember_token = null; // Clear the token after resetting the password
        $user->save();

        return redirect()->route('user.login')->with('status', 'Password reset successfully!');
    }

    public function showResetForm($token)
    {
        // Find the user by the token in the remember_token column
        $user = User::where('remember_token', $token)->first();

        if (!$user) {
            // If the token is invalid, redirect back with an error
            return redirect()->route('user.forgot')->withErrors(['token' => 'Invalid or expired password reset token.']);
        }

        // Pass the token and email to the view
        return view('frontend.auth.reset')->with([
            'token' => $token,
            'email' => $user->email,
        ]);
    }


    public function sendResetLink(Request $request)
    {
        // Validate the request
        $request->validate(['email' => 'required|email']);

        // Throttle the reset requests
        $this->checkRateLimit($request);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'We can\'t find a user with that email address.']);
        }

        // Generate the token manually
        $token = Str::random(60);
        $user->remember_token = $token;
        $user->updated_at = now();
        $user->save();

        // Send the password reset link
        Mail::send('frontend.auth.emails.password_reset', [
            'user' => $user,
            'token' => $token,
        ], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Password Reset Link');
        });

        return back()->with('status', 'Password reset link sent to your email!');
    }

    protected function checkRateLimit(Request $request)
    {
        $email = $request->input('email');
        $throttleKey = 'reset-password|' . $email;

        // Set the rate limit (5 attempts per 15 minutes)
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            throw ValidationException::withMessages([
                'email' => "Too many requests. Please try again in " . ceil($seconds / 60) . " minute(s).",
            ]);
        }

        // Record the attempt
        RateLimiter::hit($throttleKey, 900); // 900 seconds (15 minutes)
    }




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
    public function vacancy($slug)
    {
        // Fetch the vacancy by slug
        $vacancy = Vacancies::where('slug', $slug)->firstOrFail();

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
