<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Review extends Model
{
    protected $fillable = [
        'author_name', 
        'email', 
        'comment', 
        'rating',  
        'is_approved'
    ];

    // Полиморфная связь "в обратную сторону"
    public function reviewable() {
        return $this->morphTo();
    }

    // Связь с таблицей images
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
