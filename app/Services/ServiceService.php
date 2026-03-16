<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Services\SlugService;

class ServiceService
{
    public function createService(array $data, ?UploadedFile $mainPhoto = null, ?array $galleryFiles = null): Service
    {
        $data['slug'] = SlugService::generate($data['name'], Service::class);
        $service = Service::create($data);

        if ($mainPhoto) {
            $path = $mainPhoto->store('services', 'public');
            $service->images()->create(['path' => $path, 'is_main' => true]);
        }

        if ($galleryFiles) {
            foreach ($galleryFiles as $photo) {
                $path = $photo->store('services', 'public');
                $service->images()->create(['path' => $path, 'is_main' => false]);
            }
        }

        return $service;
    }

    public function updateService(Service $service, array $data, ?UploadedFile $mainPhoto = null, ?array $galleryFiles = null, array $removeImageIds = [])
    {
        if (isset($data['name']) && $data['name'] !== $service->name) {
            $data['slug'] = SlugService::generate($data['name'], Service::class, $service->id);
        }
        
        $service->update($data);

        if ($mainPhoto) {
            $oldMain = $service->images()->where('is_main', true)->first();
            if ($oldMain) {
                Storage::disk('public')->delete($oldMain->path);
                $oldMain->delete();
            }
            $path = $mainPhoto->store('services', 'public');
            $service->images()->create(['path' => $path, 'is_main' => true]);
        }

        if (!empty($removeImageIds)) {
            $images = $service->images()->whereIn('id', $removeImageIds)->get();
            foreach ($images as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }
        }

        if ($galleryFiles) {
            foreach ($galleryFiles as $photo) {
                $path = $photo->store('services', 'public');
                $service->images()->create(['path' => $path, 'is_main' => false]);
            }
        }
    }

    public function deleteService(Service $service): void
    {
        foreach ($service->images as $image) {
            Storage::disk('public')->delete($image->path);
        }
        $service->images()->delete();
        $service->delete();
    }

    // --- Публичная часть ---- //
    public function getAllServices()
    {
        return Service::with(['images' => function ($query) {
            $query->where('is_main', true);
        }])->get();
    }
}