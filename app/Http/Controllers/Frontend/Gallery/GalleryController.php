<?php

namespace App\Http\Controllers\Frontend\Gallery;

use App\Http\Controllers\Controller;
use App\Services\GalleryService;

class GalleryController extends Controller
{
    protected $galleryService;

    public function __construct(GalleryService $galleryService)
    {
        $this->galleryService = $galleryService;
    }

    public function index()
    {
        $data = $this->galleryService->getGalleryWithImages(12);

        $data['breadcrumbs'] = [
            ['title' => 'Галерея']
        ];

        return view('frontend.gallery.index', $data);
    }
}
