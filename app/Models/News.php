<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class News extends Model
{
    protected $fillable = [
        'title', 
        'slug', 
        'description'
    ];

    // Связь с таблицей images
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    
    public function getMainImageAttribute()
    {
        return $this->images()->where('is_main', true)->first() ?? $this->images()->first();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
