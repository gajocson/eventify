<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * CustomerMiddleware
 *
 * Allows only authenticated users whose role is 'customer'.
 * Admins and guests are redirected to the homepage.
 */
class CustomerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('customer')->check()) {
            return redirect('/')->with('error', 'Please sign in to access that page.');
        }

        if (Auth::guard('customer')->user()->role !== 'customer') {
            // Admin trying to access customer-only page
            return redirect('/admin/dashboard')->with('info', 'Redirected to admin dashboard.');
        }

        return $next($request);
    }
}
