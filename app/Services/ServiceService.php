<?php
namespace App\Services;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceService
{
    public function createService(array $data, ?array $files = null): Service
    {

        $slug = Str::slug($data['name']);
        $originalSlug = $slug;
        $count = 1;
        
        while (Service::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;

        $service = Service::create([
            'name'        => $data['name'],
            'slug'        => $slug,
            'description' => $data['description'],
        ]);

        if ($files) {
            foreach ($files as $photo) {
                $path = $photo->store('services', 'public');
                $service->images()->create(['path' => $path]);
            }
        }

        return $service;
    }

    public function updateService(Service $service, array $data, ?array $files, array $removeImageIds)
    {
        $slug = Str::slug($data['name']);
        $originalSlug = $slug;
        $count = 1;
        
        while (Service::where('slug', $slug)->where('id', '!=', $service->id)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;

        $service->update($data);

        // Удаление фото
        if (!empty($removeImageIds)) {
            $images = $service->images()->whereIn('id', $removeImageIds)->get();
            foreach ($images as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }
        }

        // Добавление новых фото
        if ($files) {
            foreach ($files as $photo) {
                $path = $photo->store('services', 'public');
                $service->images()->create(['path' => $path]);
            }
        }
    }

    public function deleteService(Service $service): void
    {
        $images = $service->images;

        foreach ($images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        $service->images()->delete();

        $service->delete();
    }
}