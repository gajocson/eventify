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
        'password',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}