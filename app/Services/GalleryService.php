<?php

namespace App\Services;

use App\Models\Gallery;
use App\Models\Image as ImageModel;
use Illuminate\Support\Facades\Storage;
use App\Traits\InteractsWithImages;

class GalleryService
{
    use InteractsWithImages;

    public function addToGallery(?array $files): void
    {
        if (!$files) return;

        $gallery = Gallery::firstOrCreate(['id' => 1]);

        foreach ($files as $photo) {
            $path = $this->uploadImageAsWebp($photo, 'gallery');
            
            $gallery->images()->create([
                'path' => $path
            ]);
        }
    }

    public function deleteImage(int $imageId): void
    {
        $image = ImageModel::findOrFail($imageId);
        
        Storage::disk('public')->delete($image->path);
        
        $image->delete();
    }

    public function getGalleryWithImages(int $perPage = 12): array
    {
        $gallery = Gallery::firstOrCreate(['id' => 1]);
        
        $images = $gallery->images()
            ->latest()
            ->paginate($perPage);

        return [
            'gallery' => $gallery,
            'images'  => $images,
        ];
    }
}