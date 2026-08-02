<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lead extends Model
{ 

     use HasFactory;

    // 👇 PASTE THE FILLABLE LINE DIRECTLY HERE INSIDE THE CLASS
    protected $fillable = [
        'first_name', 
        'second_name', 
        'email', 
        'contact', 
        'date', 
        'location'
    ]; 
    
}
