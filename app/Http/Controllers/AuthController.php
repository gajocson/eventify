<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // ─────────────────────────────────────────────
    // POST /auth/login  →  JSON response
    // Single form handles both customer and admin
    // ─────────────────────────────────────────────
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required'    => 'Email is required.',
            'email.email'       => 'Enter a valid email address.',
            'password.required' => 'Password is required.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()->toArray(),
            ], 422);
        }

        $credentials = $request->only('email', 'password');
        $remember    = $request->boolean('remember');

        if (Auth::guard('customer')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::guard('customer')->user();

            // Determine display name and redirect destination based on role
            $displayName = $user->first_name;
            $role        = $user->role;

            if ($role === 'admin') {
                $greeting    = 'Welcome, Admin ' . $displayName . '!';
                $redirectUrl = route('admin.dashboard');
            } else {
                $greeting    = 'Welcome back, ' . $displayName . '!';
                $redirectUrl = null; // stay on page for customers
            }

            return response()->json([
                'success'     => true,
                'message'     => $greeting,
                'role'        => $role,
                'redirectUrl' => $redirectUrl,
                'user'        => [
                    'name'  => $user->first_name . ' ' . $user->last_name,
                    'email' => $user->email,
                ],
            ]);
        }

        return response()->json([
            'success' => false,
            'errors'  => [
                'email' => ['Invalid email or password.'],
            ],
        ], 401);
    }

    // ─────────────────────────────────────────────
    // POST /auth/logout
    // ─────────────────────────────────────────────
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect('/')->with('success', 'You have been signed out.');
    }

    // ─────────────────────────────────────────────
    // GET /profile  (protected by auth:customer + customer.only)
    // ─────────────────────────────────────────────
    public function profile()
    {
        $user = Auth::guard('customer')->user();

        // Load all bookings with their messages
        $allBookings = \App\Models\EventBooking::with(['messages'])
            ->where('customer_id', $user->customer_id)
            ->orderByDesc('created_at')
            ->get();

        // Current = pending or confirmed
        $currentBookings = $allBookings->filter(function ($b) {
            return in_array($b->status, ['pending', 'confirmed']);
        })->values();

        // History = cancelled or completed
        $historyBookings = $allBookings->filter(function ($b) {
            return !in_array($b->status, ['pending', 'confirmed']);
        })->values();

        // Bookings that have at least one message (for messages tab)
        $messageBookings = $allBookings->filter(function ($b) {
            return $b->messages->count() > 0;
        })->values();

        return view('profile', compact(
            'user',
            'currentBookings',
            'historyBookings',
            'messageBookings'
        ));
    }

    // ─────────────────────────────────────────────
    // GET /auth/user  →  returns current user JSON + role
    // Used by JS on page load to restore dropdown state
    // ─────────────────────────────────────────────
    public function authUser()
    {
        if (Auth::guard('customer')->check()) {
            $user = Auth::guard('customer')->user();
            return response()->json([
                'authenticated' => true,
                'role'          => $user->role,
                'user'          => [
                    'name'  => $user->first_name . ' ' . $user->last_name,
                    'email' => $user->email,
                ],
            ]);
        }

        return response()->json(['authenticated' => false]);
    }
}
