<?php

namespace App\Http\Controllers;

use App\Mail\AgentRegisteredMail;
use App\Models\Document;
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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

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
    public function verify()
    {
        return view('frontend.verify.index');
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

        // Get all vacancies with status 1 and order them randomly
        $vacancies = Vacancies::where('status', 1)
            ->inRandomOrder() // This will shuffle the results randomly
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

    public function agentRegister()
    {
        return view('auth.agent');
    }
    public function agentStore(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'country' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'g-recaptcha-response' => 'required', // Ensure reCAPTCHA is filled
        ]);


        // Verify reCAPTCHA
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        $responseData = $response->json();

        if (!$responseData['success']) {
            return back()->withErrors(['captcha' => 'reCAPTCHA verification failed.'])->withInput();
        }


        // Create the agent (Assume user_type is used to differentiate agent from others)
        $agent = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'country' => $validated['country'],
            'password' => bcrypt($validated['password']),
            'user_type' => 'unverifiedagent',
        ]);

        Mail::to($agent->email)->send(new AgentRegisteredMail($agent));

        // Optionally log the user in after registration
        auth()->login($agent);

        // Redirect to a dashboard or success page
        return redirect()->route('dashboard')->with('success', 'Registration successful!');
    }
    public function agentStoreDocuments(Request $request)
    {
        $request->validate([
            'passport' => 'file|mimes:jpg,jpeg,png,webp,pdf|max:10240',
            'br'       => 'file|mimes:jpg,jpeg,png,webp,pdf|max:10240',
            'police'   => 'file|mimes:jpg,jpeg,png,webp,pdf|max:10240',
            'address'  => 'file|mimes:jpg,jpeg,png,webp,pdf|max:10240',
        ]);

        $userId = auth()->id();
        $documentTypes = ['passport', 'br', 'police', 'address'];

        foreach ($documentTypes as $type) {
            if ($request->hasFile($type)) {
                $file = $request->file($type);

                // Get file details
                $filePath = $file->store('Documents', 'public'); // Save to public disk
                $fileOriginalName = $file->getClientOriginalName();
                $fileSize = $file->getSize();
                $fileType = $file->getMimeType();

                // Check for existing document
                $existingDocument = Document::where('user_id', $userId)
                    ->where('document_type', $type)
                    ->first();

                if ($existingDocument) {
                    // Delete old file
                    Storage::disk('public')->delete($existingDocument->file_path);

                    // Update existing record
                    $existingDocument->update([
                        'file_path' => $filePath,
                        'file_original_name' => $fileOriginalName,
                        'file_size' => $fileSize,
                        'file_type' => $fileType,
                    ]);
                } else {
                    // Create new record
                    Document::create([
                        'user_id' => $userId,
                        'document_type' => $type,
                        'file_path' => $filePath,
                        'file_original_name' => $fileOriginalName,
                        'file_size' => $fileSize,
                        'file_type' => $fileType,
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Your documents have been uploaded. Our team will manually review them and update you via email. Once approved, you will gain access to the agent portal.');
    }
}
