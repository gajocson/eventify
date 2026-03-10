<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingMessage extends Model
{
    protected $fillable = [
        'booking_id',
        'sender_type',
        'sender_id',
        'message',
    ];

    /**
     * The booking this message belongs to.
     */
    public function booking()
    {
        return $this->belongsTo(EventBooking::class, 'booking_id');
    }

    /**
     * The customer sender (only populated when sender_type = 'customer').
     */
    public function senderCustomer()
    {
        return $this->belongsTo(Customer::class, 'sender_id', 'customer_id');
    }

    /**
     * Helper: is this message from the admin?
     */
    public function isFromAdmin(): bool
    {
        return $this->sender_type === 'admin';
    }

    /**
     * Helper: is this message from the customer?
     */
    public function isFromCustomer(): bool
    {
        return $this->sender_type === 'customer';
    }
}
