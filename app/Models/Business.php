<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Business extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'business_name',
        'business_email',
        'business_cont_num',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}