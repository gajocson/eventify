<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\EventBooking;
use App\Models\BookingMessage;


class Customer extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'customer_id'; // non-standard PK
    protected $keyType    = 'int';
    public    $incrementing = true;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'city',
        'password',
        'role',
        'remember_token',
    ];

    /** Convenience helpers for role checks */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * All event bookings made by this customer.
     */
    public function bookings()
    {
        return $this->hasMany(EventBooking::class, 'customer_id', 'customer_id');
    }

    /**
     * All messages sent by this customer.
     */
    public function messages()
    {
        return $this->hasMany(BookingMessage::class, 'sender_id', 'customer_id')
                    ->where('sender_type', 'customer');
    }
}