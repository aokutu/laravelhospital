<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'client_name',
        'phone_number',
        'car_number',
    ];
}