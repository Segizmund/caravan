<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Services\SlugService;

class CategoryService
{
    public function createCategory(array $data, ?UploadedFile $mainPhoto = null, ?array $galleryFiles = null): Category
    {
        $data['slug'] = SlugService::generate($data['name'], Category::class);
        $category = Category::create($data);

        if ($mainPhoto) {
            $path = $mainPhoto->store('category', 'public');
            $category->images()->create(['path' => $path, 'is_main' => true]);
        }

        if ($galleryFiles) {
            foreach ($galleryFiles as $photo) {
                $path = $photo->store('category', 'public');
                $category->images()->create(['path' => $path, 'is_main' => false]);
            }
        }

        return $category;
    }

    public function updateCategory(Category $category, array $data, ?UploadedFile $mainPhoto = null, ?array $galleryFiles = null, array $removeImageIds = []): Category
    {
        if (isset($data['name']) && $data['name'] !== $category->name) {
            $data['slug'] = SlugService::generate($data['name'], Category::class, $category->id);
        }
        
        $category->update($data);

        if ($mainPhoto) {
            $oldMain = $category->images()->where('is_main', true)->first();
            if ($oldMain) {
                Storage::disk('public')->delete($oldMain->path);
                $oldMain->delete();
            }
            $path = $mainPhoto->store('category', 'public');
            $category->images()->create(['path' => $path, 'is_main' => true]);
        }

        if (!empty($removeImageIds)) {
            $images = $category->images()->whereIn('id', $removeImageIds)->get();
            foreach ($images as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }
        }

        if ($galleryFiles) {
            foreach ($galleryFiles as $photo) {
                $path = $photo->store('category', 'public');
                $category->images()->create(['path' => $path, 'is_main' => false]);
            }
        }

        return $category;
    }

    public function deleteCategory(Category $category): void
    {
        foreach ($category->images as $image) {
            Storage::disk('public')->delete($image->path);
        }
        $category->images()->delete();
        $category->delete();
    }
}