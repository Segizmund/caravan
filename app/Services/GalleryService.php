<?php

namespace App\Services;

use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class GalleryService
{
    public function addToGallery(?array $files): void
    {
        if (!$files) return;

        $gallery = Gallery::firstOrCreate(['id' => 1]);

        foreach ($files as $photo) {
            $path = $photo->store('gallery', 'public');
            
            $gallery->images()->create([
                'path' => $path
            ]);
        }
    }

    public function deleteImage(int $imageId): void
    {
        $image = Image::findOrFail($imageId);
        Storage::disk('public')->delete($image->path);
        $image->delete();
    }

    public function getGalleryWithImages(int $perPage = 12): array
    {
        $gallery = Gallery::firstOrCreate(['id' => 1]);
        
        $images = $image = $gallery->images()
            ->latest()
            ->paginate($perPage);

        return [
            'gallery' => $gallery,
            'images'  => $images,
        ];
    }
}