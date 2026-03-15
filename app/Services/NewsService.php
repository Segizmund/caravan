<?php
namespace App\Services;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsService
{
    public function createNews(array $data, ?array $files = null): News
    {

        $slug = Str::slug($data['title']);
        $originalSlug = $slug;
        $count = 1;
        
        while (News::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;

        $news = News::create([
            'title'        => $data['title'],
            'slug'        => $slug,
            'description' => $data['description'],
        ]);

        if ($files) {
            foreach ($files as $photo) {
                $path = $photo->store('news', 'public');
                $news->images()->create(['path' => $path]);
            }
        }

        return $news;
    }

    public function updateNews(News $news, array $data, ?array $files, array $removeImageIds)
    {
        $slug = Str::slug($data['title']);
        $originalSlug = $slug;
        $count = 1;
        
        while (News::where('slug', $slug)->where('id', '!=', $news->id)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;

        $news->update($data);

        // Удаление фото
        if (!empty($removeImageIds)) {
            $images = $news->images()->whereIn('id', $removeImageIds)->get();
            foreach ($images as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }
        }

        // Добавление новых фото
        if ($files) {
            foreach ($files as $photo) {
                $path = $photo->store('news', 'public');
                $news->images()->create(['path' => $path]);
            }
        }
    }

    public function deleteNews(News $news): void
    {
        $images = $news->images;

        foreach ($images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        $news->images()->delete();

        $news->delete();
    }
}