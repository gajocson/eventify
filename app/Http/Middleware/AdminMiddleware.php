<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * AdminMiddleware
 *
 * Allows only authenticated users whose role is 'admin'.
 * Everyone else is redirected to the homepage.
 */
class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('customer')->check()) {
            return redirect('/')->with('error', 'Please sign in to access that page.');
        }

        if (Auth::guard('customer')->user()->role !== 'admin') {
            return redirect('/')->with('error', 'Access denied. Admin accounts only.');
        }

        return $next($request);
    }
}
