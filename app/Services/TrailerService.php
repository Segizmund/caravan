<?php
namespace App\Services;

use App\Models\Trailer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TrailerService
{
    // Получение прицепа со всеми опциями и одобренными отзывами //
    public function getTrailerDetails(int $id)
    {
        return Trailer::with(['options', 'reviews' => function($query) {
            $query->where('is_approved', true);
        }])->findOrFail($id);
    }

    // Получение списка прицепов для каталога //
    public function getAllTrailers()
    {
        return Trailer::latest()->get();
    }

    public function createTrailer(array $data, ?array $files = null): Trailer
    {
        $slug = Str::slug($data['name']);
        $originalSlug = $slug;
        $count = 1;
        
        while (Trailer::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;

        $trailer = Trailer::create($data);

        if ($files) {
            foreach ($files as $index => $photo) {
                $path = $photo->store('trailers', 'public');
                $trailer->images()->create([
                    'path' => $path,
                    'is_main' => ($index === 0)
                ]);
            }
        }

        return $trailer;
    }

    public function updateTrailer(Trailer $trailer, array $data, ?array $files, array $removeImageIds)
    {
        $slug = Str::slug($data['name']);
        $originalSlug = $slug;
        $count = 1;

        while (Trailer::where('slug', $slug)->where('id', '!=', $trailer->id)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;
        
        $trailer->update($data);

        if (!empty($removeImageIds)) {
            $images = $trailer->images()->whereIn('id', $removeImageIds)->get();
            foreach ($images as $image) {
                \Storage::disk('public')->delete($image->path);
                $image->delete();
            }
        }

        if ($files) {
            foreach ($files as $photo) {
                $path = $photo->store('trailers', 'public');
                $trailer->images()->create(['path' => $path]);
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
}