<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Gallery extends Model
{
    protected $fillable = [
        'id'
    ];
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
