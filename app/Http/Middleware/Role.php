<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        // Split the roles into an array
        $roles = explode('|', $roles);

        // Check if the user is logged in and has one of the roles
        if (Auth::check() && in_array(Auth::user()->user_type, $roles)) {
            return $next($request);
        }

        // If not authenticated or does not have the required role, return a 401
        abort(401);
    }
}
