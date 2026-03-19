<?php
namespace App\Services;

use App\Models\Trailer;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Services\SlugService;

class TrailerService
{
    public function createTrailer(array $data, ?UploadedFile $mainPhoto = null, ?array $galleryFiles = null): Trailer
    {
        $data['slug'] = SlugService::generate($data['name'], Trailer::class);

        $trailer = Trailer::create($data);

        // Сохраняем главное фото
        if ($mainPhoto) {
            $path = $mainPhoto->store('trailers', 'public');
            $trailer->images()->create(['path' => $path, 'is_main' => true]);
        }

        // Сохраняем галерею
        if ($galleryFiles) {
            foreach ($galleryFiles as $photo) {
                $path = $photo->store('trailers', 'public');
                $trailer->images()->create(['path' => $path, 'is_main' => false]);
            }
        }

        return $trailer;
    }

    public function updateTrailer(Trailer $trailer, array $data, ?UploadedFile $mainPhoto = null, ?array $galleryFiles = null, array $removeImageIds = [])
    {
        // Обновление данных
        if (isset($data['name']) && $data['name'] !== $trailer->name) {
            $data['slug'] = SlugService::generate($data['name'], Trailer::class, $trailer->id);
        }
        $trailer->update($data);

        // Обработка замены ГЛАВНОГО фото
        if ($mainPhoto) {
            $oldMain = $trailer->images()->where('is_main', true)->first();
            if ($oldMain) {
                Storage::disk('public')->delete($oldMain->path);
                $oldMain->delete();
            }
            $path = $mainPhoto->store('trailers', 'public');
            $trailer->images()->create(['path' => $path, 'is_main' => true]);
        }

        // Удаление выбранных фото из галереи
        if (!empty($removeImageIds)) {
            $images = $trailer->images()->whereIn('id', $removeImageIds)->get();
            foreach ($images as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }
        }

        // Добавление новых фото в галерею
        if ($galleryFiles) {
            foreach ($galleryFiles as $photo) {
                $path = $photo->store('trailers', 'public');
                $trailer->images()->create(['path' => $path, 'is_main' => false]);
            }
        }
    }

    public function deleteTrailer(Trailer $trailer): void
    {
        $images = $trailer->images;

        foreach ($images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        $trailer->images()->delete();

        $trailer->delete();
    }

    // --- Публичная часть ---
    public function getPaginatedTrailers(int $perPage = 12)
    {
        return Trailer::with(['images' => function($query) {
            $query->where('is_main', true);
        }])->latest()->paginate($perPage);
    }

    public function getPaginatedTrailersGrouped(int $perPageCategories = 3)
    {
        return Category::whereHas('trailers')
            ->with(['trailers' => function ($query) {
                $query->with(['images' => fn($q) => $q->where('is_main', true)])
                    ->take(6);
            }])
            ->paginate($perPageCategories);
    }

    public function getTrailersByCategoryIdPaginated(int $categoryId, int $page = 1)
    {
        return Trailer::where('category_id', $categoryId)
            ->with(['images' => fn($q) => $q->where('is_main', true)])
            ->latest()
            ->paginate(6, ['*'], 'page', $page);
    }

    public function getTrailerDetails(Trailer $trailer): array
    {
        $trailer->load(['category', 'images']);

        $mainImage = $trailer->images->where('is_main', true)->first();
        $additionalImages = $trailer->images->where('is_main', false);

        return [
            'trailer'          => $trailer,
            'mainImage'        => $mainImage,
            'additionalImages' => $additionalImages,
        ];
    }

}