<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EventBooking;

class AdminController extends Controller
{
    /**
     * GET /admin/dashboard
     */
    public function dashboard()
    {
        $admin = Auth::guard('customer')->user();

        $bookings = EventBooking::with('customer')
            ->orderByDesc('created_at')
            ->get();

        $totalBookings   = $bookings->count();
        $totalCustomers  = $bookings->whereNotNull('customer_id')
                                    ->pluck('customer_id')
                                    ->unique()
                                    ->count();

        return view('admin.dashboard', compact(
            'admin',
            'bookings',
            'totalBookings',
            'totalCustomers'
        ));
    }

    /**
     * PATCH /admin/bookings/{id}/message
     * Save the admin's message for a booking.
     */
    public function sendMessage(Request $request, $id)
    {
        $request->validate([
            'admin_message' => 'required|string|max:5000',
        ]);

        $booking = EventBooking::findOrFail($id);
        $booking->update(['admin_message' => $request->admin_message]);

        return response()->json(['success' => true]);
    }

    /**
     * PATCH /admin/bookings/{id}/status
     * Update booking status (pending / confirmed / cancelled).
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $booking = EventBooking::findOrFail($id);
        $booking->update(['status' => $request->status]);

        return response()->json(['success' => true]);
    }
}
