<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminPackage extends Model
{
    protected $table = 'admin_packages';

    protected $fillable = [
        'name',
        'emoji',
        'description',
        'image_path',
        'base_price',
    ];
}
