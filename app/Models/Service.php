<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Service extends Model
{
    protected $fillable = [
        'name', 
        'slug', 
        'description'
    ];

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