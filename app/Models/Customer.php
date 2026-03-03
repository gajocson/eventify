<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'phone',
    'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}