<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'first_phone', 
        'second_phone', 
        'email'
    ];
}
