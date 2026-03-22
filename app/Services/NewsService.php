<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Services\SlugService;
use App\Traits\InteractsWithImages;

class NewsService
{
    use InteractsWithImages;

    public function createNews(array $data, ?UploadedFile $mainPhoto = null, ?array $galleryFiles = null): News
    {
        $data['slug'] = SlugService::generate($data['title'], News::class);
        $news = News::create($data);

        if ($mainPhoto) {
            $path = $this->uploadImageAsWebp($mainPhoto, 'news');
            $news->images()->create(['path' => $path, 'is_main' => true]);
        }

        if ($galleryFiles) {
            foreach ($galleryFiles as $photo) {
                $path = $this->uploadImageAsWebp($photo, 'news');
                $news->images()->create(['path' => $path, 'is_main' => false]);
            }
        }

        return $news;
    }

    public function updateNews(News $news, array $data, ?UploadedFile $mainPhoto = null, ?array $galleryFiles = null, array $removeImageIds = [])
    {
        if (isset($data['title']) && $data['title'] !== $news->title) {
            $data['slug'] = SlugService::generate($data['title'], News::class, $news->id);
        }
        
        $news->update($data);

        if ($mainPhoto) {
            $oldMain = $news->images()->where('is_main', true)->first();
            if ($oldMain) {
                Storage::disk('public')->delete($oldMain->path);
                $oldMain->delete();
            }
            $path = $this->uploadImageAsWebp($mainPhoto, 'news');
            $news->images()->create(['path' => $path, 'is_main' => true]);
        }

        if (!empty($removeImageIds)) {
            $images = $news->images()->whereIn('id', $removeImageIds)->get();
            foreach ($images as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }
        }

        if ($galleryFiles) {
            foreach ($galleryFiles as $photo) {
                $path = $this->uploadImageAsWebp($photo, 'news');
                $news->images()->create(['path' => $path, 'is_main' => false]);
            }
        }
    }

    public function deleteNews(News $news): void
    {
        foreach ($news->images as $image) {
            Storage::disk('public')->delete($image->path);
        }
        $news->images()->delete();
        $news->delete();
    }

    // --- Публичная часть ---- //
    public function getAllNews()
    {
        $news = News::with('images')->latest()->paginate(12);
        return ['news' => $news];
    }

    public function getNewsDetails(News $news): array
    {
        $news->load(['images']);

        $mainImage = $news->images->where('is_main', true)->first() 
                    ?? $news->images->first();
                    
        $additionalImages = $news->images->where('is_main', false);

        return [
            'news'          => $news,
            'mainImage'        => $mainImage,
            'additionalImages' => $additionalImages,
        ];
    }
}