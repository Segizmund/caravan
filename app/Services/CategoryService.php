<?php
namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    public function createCategory(array $data, ?array $files = null): Category
    {
        $slug = Str::slug($data['name']);
        $originalSlug = $slug;
        $count = 1;
        
        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $data['slug'] = $slug;

        $category = Category::create($data);

        if ($files) {
            foreach ($files as $photo) {
                $path = $photo->store('category', 'public');
                $category->images()->create(['path' => $path]);
            }
        }

        return $category;
    }

    public function updateCategory(Category $category, array $data, ?array $files = null, array $removeImageIds = []): Category
    {
        $slug = Str::slug($data['name']);
        $originalSlug = $slug;
        $count = 1;
        while (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        
        $data['slug'] = $slug;
        $category->update($data);

        // Удаление фото
        if (!empty($removeImageIds)) {
            $images = $category->images()->whereIn('id', $removeImageIds)->get();
            foreach ($images as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }
        }

        // Добавление новых фото
        if ($files) {
            foreach ($files as $photo) {
                $path = $photo->store('category', 'public');
                $category->images()->create(['path' => $path]);
            }
        }

        return $category;
    }

    public function deleteCategory(Category $category): void
    {
        $images = $category->images;

        foreach ($images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        $category->images()->delete();

        $category->delete();
    }
}