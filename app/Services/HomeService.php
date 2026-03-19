<?php
namespace App\Services;

use App\Models\Service;
use App\Models\Category;
use App\Models\Image;
use App\Models\Gallery;

class HomeService
{
    public function getHomePageData(): array
    {
        return [
            'gallery'    => Image::where('imageable_type', Gallery::class)->inRandomOrder()->limit(6)->get(),
        ];
    }
}