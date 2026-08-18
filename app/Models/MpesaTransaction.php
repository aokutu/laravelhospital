<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MpesaTransaction extends Model
{
    protected $fillable = [
        'mpesa_code',
        'amount',
        'phone',
        'first_name',
        'middle_name',
        'last_name',
        'bill_ref'
    ];
}
