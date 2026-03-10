<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EventBooking;

class BookingController extends Controller
{
    /**
     * GET /booking
     * Show the booking page (package + services passed via POST from homepage).
     */
    public function show(Request $request)
    {
        $package  = $request->input('package', '');
        $services = $request->input('services', []);

        if (!is_array($services)) {
            $services = [$services];
        }

        return view('booking', [
            'package'  => $package,
            'services' => $services,
        ]);
    }

    /**
     * POST /booking/store
     * Save the confirmed booking to the database.
     * Returns JSON { success: true, message: '...' }
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_name'   => 'required|string|max:255',
            'services'       => 'required|array|min:1',
            'sub_services'   => 'required|array',
            'guest_count'    => 'required|integer|min:1',
            'event_date'     => 'required|date|after:today',
            'total_price'    => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:100',
        ]);

        $customer = Auth::guard('customer')->user();

        EventBooking::create([
            'customer_id'    => $customer ? $customer->customer_id : null,
            'package_name'   => $validated['package_name'],
            'services'       => $validated['services'],
            'sub_services'   => $validated['sub_services'],
            'guest_count'    => $validated['guest_count'],
            'event_date'     => $validated['event_date'],
            'total_price'    => $validated['total_price'],
            'payment_method' => $validated['payment_method'],
            'status'         => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Booking confirmed! Our team will be in touch soon.',
        ]);
    }
}
