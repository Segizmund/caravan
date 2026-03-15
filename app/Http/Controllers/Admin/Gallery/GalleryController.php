<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Gallery;
use App\Services\GalleryService;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    protected $galleryService;

    public function __construct(GalleryService $galleryService)
    {
        $this->galleryService = $galleryService;
    }

    public function index()
    {
        $images = Image::where('imageable_type', Gallery::class)
            ->latest()
            ->get();

        return view('admin.gallery.index', compact('images'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $this->galleryService->addToGallery($request->file('photos'));

        return redirect()->route('admin.gallery.index')->with('success', 'Фото добавлены!');
    }

    public function destroy($id)
    {
        $this->galleryService->deleteImage($id);
        return redirect()->back()->with('success', 'Фото удалено!');
    }
}