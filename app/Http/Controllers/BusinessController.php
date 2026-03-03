<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'business_name'      => 'required|string|max:255',
            'business_email'     => 'required|email|unique:businesses,business_email',
            'business_cont_num'  => 'required|regex:/^(09\d{9}|\+639\d{9})$/',
            'password'           => 'required|string|confirmed|min:6',
            'termsBusiness'      => 'accepted',
        ], [
            'termsBusiness.accepted' => 'You must accept the terms and conditions.',
            'password.confirmed'     => 'Passwords do not match.',
            'business_cont_num.regex'=> 'Invalid Philippine phone number format.',
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
            Business::create([
                'business_name'     => $request->business_name,
                'business_email'    => $request->business_email,
                'business_cont_num' => $request->business_cont_num,
                'password'          => Hash::make($request->password),
            ]);

            $successMessage = 'Business registration successful! You can now log in.';

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