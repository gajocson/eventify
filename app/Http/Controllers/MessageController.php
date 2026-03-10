<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EventBooking;
use App\Models\BookingMessage;

class MessageController extends Controller
{
    /**
     * POST /profile/bookings/{id}/reply
     * Customer replies to an admin message on their booking.
     */
    public function userReply(Request $request, $bookingId)
    {
        $request->validate([
            'message' => 'required|string|max:5000',
        ], [
            'message.required' => 'Please enter a message.',
        ]);

        $user    = Auth::guard('customer')->user();
        $booking = EventBooking::where('id', $bookingId)
                               ->where('customer_id', $user->customer_id)
                               ->firstOrFail();

        $msg = BookingMessage::create([
            'booking_id'  => $booking->id,
            'sender_type' => 'customer',
            'sender_id'   => $user->customer_id,
            'message'     => $request->message,
        ]);

        return response()->json([
            'success'     => true,
            'message_obj' => [
                'id'          => $msg->id,
                'sender_type' => 'customer',
                'sender_name' => $user->first_name . ' ' . $user->last_name,
                'message'     => $msg->message,
                'created_at'  => $msg->created_at->format('M d, Y h:i A'),
            ],
        ]);
    }

    /**
     * PATCH /admin/bookings/{id}/message
     * Admin sends / overwrites the initial booking message AND inserts a new thread entry.
     */
    public function adminSend(Request $request, $bookingId)
    {
        $request->validate([
            'message' => 'required|string|max:5000',
        ]);

        $booking = EventBooking::findOrFail($bookingId);

        // Store in thread table
        $msg = BookingMessage::create([
            'booking_id'  => $booking->id,
            'sender_type' => 'admin',
            'sender_id'   => null,
            'message'     => $request->message,
        ]);

        // Also update legacy admin_message column for backward compat
        $booking->update(['admin_message' => $request->message]);

        return response()->json([
            'success'     => true,
            'message_obj' => [
                'id'          => $msg->id,
                'sender_type' => 'admin',
                'sender_name' => 'Admin',
                'message'     => $msg->message,
                'created_at'  => $msg->created_at->format('M d, Y h:i A'),
            ],
        ]);
    }

    /**
     * GET /admin/bookings/{id}/messages
     * Return full conversation thread for admin dashboard.
     */
    public function adminThread($bookingId)
    {
        $booking = EventBooking::with('customer')->findOrFail($bookingId);

        $messages = BookingMessage::where('booking_id', $bookingId)
            ->orderBy('created_at')
            ->get()
            ->map(function ($m) {
                return [
                    'id'          => $m->id,
                    'sender_type' => $m->sender_type,
                    'sender_name' => $m->sender_type === 'admin'
                        ? 'Admin'
                        : ($m->senderCustomer ? $m->senderCustomer->first_name . ' ' . $m->senderCustomer->last_name : 'Customer'),
                    'message'     => $m->message,
                    'created_at'  => $m->created_at->format('M d, Y h:i A'),
                ];
            });

        return response()->json([
            'success'  => true,
            'messages' => $messages,
        ]);
    }
}
