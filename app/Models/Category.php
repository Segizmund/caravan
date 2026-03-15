<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Category extends Model
{
    protected $fillable = [
        'name', 
        'slug'
    ];

    public function trailers()
    {
        return $this->hasMany(Trailer::class, 'category_id');
    }

    // Фотографии работ через полиморфную связь
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    
    // Хелпер для получения первой картинки
    public function getMainImageAttribute()
    {
        return $this->images()->first();
    }
}
