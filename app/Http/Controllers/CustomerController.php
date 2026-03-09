<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * POST /register/customer
     * Always registers with role = 'customer' — no frontend role selection.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:customers,email',
            'password'   => 'required|string|confirmed|min:6',
            'terms'      => 'accepted',
        ], [
            'terms.accepted'     => 'You must accept the terms and conditions.',
            'password.confirmed' => 'Passwords do not match.',
            'email.unique'       => 'An account with this email already exists.',
            'password.min'       => 'Password must be at least 6 characters.',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors()->toArray(),
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        try {
            Customer::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'password'   => Hash::make($request->password),
                'role'       => 'customer', // always customer via registration
            ]);

            $successMessage = 'Account created! You can now sign in.';

            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => $successMessage]);
            }

            Session::flash('success', $successMessage);

        } catch (\Exception $e) {
            $errorMessage = 'Registration failed. Please try again.';

            if ($request->ajax()) {
                return response()->json(['success' => false, 'errors' => ['general' => [$errorMessage]]], 500);
            }

            Session::flash('error', $errorMessage);
        }

        return redirect()->back();
    }
}