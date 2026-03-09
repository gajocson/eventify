<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
}