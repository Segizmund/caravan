<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Trailer extends Model
{
    protected $casts = [
        'additional_features' => 'array',
    ];

    protected $fillable = [
        'name', 
        'slug', 
        'price', 
        'length_mm', 
        'width_mm', 
        'board_height_mm', 
        'empty_weight_kg', 
        'max_load_capacity_kg', 
        'tested_load_capacity_kg', 
        'drawbar', 
        'suspension', 
        'coupling_device', 
        'hub', 
        'axle', 
        'floor',
        'category_id',
        'additional_features',
    ];

    // Связь с опциями
    public function options() {
        return $this->belongsToMany(Option::class, 'option_trailer');
    }

    // Связь с таблицей images
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getMainImageAttribute()
    {
        return $this->images()->where('is_main', true)->first() ?? $this->images()->first();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function approvedReviews()
    {
        return $this->reviews()->where('is_approved', true)->latest();
    }
}
