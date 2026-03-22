<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

trait InteractsWithImages
{
    protected function uploadImageAsWebp(UploadedFile $file, string $folder, int $maxWidth = 1920): string
    {
        $manager = new ImageManager(new Driver());
        
        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = $folder . '/' . $name . '_' . uniqid() . '.webp';

        $image = $manager->read($file);
        
        if ($image->width() > $maxWidth) {
            $image->scale(width: $maxWidth);
        }

        $encoded = $image->toWebp(80);

        Storage::disk('public')->put($fileName, (string) $encoded);

        return $fileName;
    }
}