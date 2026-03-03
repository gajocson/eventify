<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:customers,email',
            'phone'      => 'nullable|string|max:20',
            'password'   => 'required|string|confirmed|min:6',
            'terms'      => 'accepted',
        ], [
            'terms.accepted' => 'You must accept the terms and conditions.',
            'password.confirmed' => 'Passwords do not match.',
        ]);

        // If validation fails
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'errors' => $validator->errors()->all()
                ]);
            }
            return back()->withErrors($validator)->withInput();
        }

        try {
            Customer::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'phone'      => $request->phone,
                'password'   => Hash::make($request->password),
            ]);

            $successMessage = 'Customer registration successful! You can now log in.';

            if ($request->ajax()) {
                return response()->json(['success' => $successMessage]);
            }

            Session::flash('success', $successMessage);

        } catch (\Exception $e) {

            $errorMessage = 'Registration failed. Please try again.';

            if ($request->ajax()) {
                return response()->json(['errors' => [$errorMessage]]);
            }

            Session::flash('error', $errorMessage);
        }

        return redirect()->back();
    }
}