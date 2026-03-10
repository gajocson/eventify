<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventBooking extends Model
{
    protected $table = 'event_bookings';

    protected $fillable = [
        'customer_id',
        'package_name',
        'services',
        'sub_services',
        'guest_count',
        'event_date',
        'total_price',
        'payment_method',
        'status',
        'admin_message',
    ];

    protected $casts = [
        'services'     => 'array',
        'sub_services' => 'array',
        'event_date'   => 'date',
        'total_price'  => 'decimal:2',
    ];

    /**
     * The customer who made this booking.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    /**
     * Formatted status label with CSS class.
     */
    public function statusBadgeClass(): string
    {
        return match ($this->status) {
            'confirmed'  => 'bk-badge--confirmed',
            'cancelled'  => 'bk-badge--cancelled',
            default      => 'bk-badge--pending',
        };
    }
}
