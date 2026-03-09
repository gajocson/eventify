<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // ─────────────────────────────────────────────
    // POST /auth/login  →  JSON response
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

            return response()->json([
                'success' => true,
                'message' => 'Welcome back, ' . $user->first_name . '!',
                'user'    => [
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
    // GET /profile  (protected by auth:customer)
    // ─────────────────────────────────────────────
    public function profile()
    {
        $user = Auth::guard('customer')->user();
        return view('profile', compact('user'));
    }

    // ─────────────────────────────────────────────
    // GET /auth/user  →  returns current user JSON
    // Used by JS on page load to set dropdown state
    // ─────────────────────────────────────────────
    public function authUser()
    {
        if (Auth::guard('customer')->check()) {
            $user = Auth::guard('customer')->user();
            return response()->json([
                'authenticated' => true,
                'user' => [
                    'name'  => $user->first_name . ' ' . $user->last_name,
                    'email' => $user->email,
                ],
            ]);
        }

        return response()->json(['authenticated' => false]);
    }
}
