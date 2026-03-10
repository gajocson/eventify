<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * PATCH /profile/phone
     * Add or update the user's phone number.
     */
    public function updatePhone(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:30',
        ], [
            'phone.required' => 'Please enter a phone number.',
        ]);

        $user = Auth::guard('customer')->user();
        $user->update(['phone' => $request->phone]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Phone number updated successfully.',
                'phone'   => $user->phone,
            ]);
        }

        return back()->with('success', 'Phone number updated.');
    }

    /**
     * PATCH /profile/password
     * Change the user's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'          => 'required|string',
            'new_password'              => 'required|string|min:6|confirmed',
            'new_password_confirmation' => 'required|string',
        ], [
            'new_password.min'       => 'New password must be at least 6 characters.',
            'new_password.confirmed' => 'New passwords do not match.',
        ]);

        $user = Auth::guard('customer')->user();

        if (!Hash::check($request->current_password, $user->password)) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'errors'  => ['current_password' => ['Current password is incorrect.']],
                ], 422);
            }
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Password updated successfully.',
            ]);
        }

        return back()->with('success', 'Password updated successfully.');
    }
}
