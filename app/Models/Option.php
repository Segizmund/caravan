<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'name', 
        'price_modifier'
    ];
    //связь с товаром
    public function trailers() {
        return $this->belongsToMany(Trailer::class, 'option_trailer');
    }
}
