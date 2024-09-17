<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $user->status === 1) {
            return $next($request);
        } else {
            // Log out the user
            // Auth::logout();

            // Optionally invalidate the session
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Redirect to the login page with an error message
            return redirect()->route('login')->with('error', 'Access denied.');
        }

        // Redirect or abort with a status code if user status is not 1

    }
}
