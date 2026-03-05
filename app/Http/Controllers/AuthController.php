<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['errors' => $validator->errors()->all()]);
            }
            return back()->withErrors($validator)->withInput();
        }

        // Attempt to find customer by email
        $customer = Customer::where('email', $request->email)->first();

        if ($customer && Hash::check($request->password, $customer->password)) {
            // Store customer info in session
            session(['customer_id' => $customer->id, 'customer_name' => $customer->first_name]);

            $successMessage = 'Welcome back, ' . $customer->first_name . '!';

            if ($request->ajax()) {
                return response()->json([
                    'success'  => $successMessage,
                    'redirect' => '/',
                ]);
            }

            return redirect('/')->with('login_success', $successMessage);
        }

        $errorMessage = 'Invalid email or password.';

        if ($request->ajax()) {
            return response()->json(['errors' => [$errorMessage]]);
        }

        return back()->with('login_error', $errorMessage);
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['customer_id', 'customer_name']);
        return redirect('/');
    }
}
