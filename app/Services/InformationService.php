<?php
namespace App\Services;

use App\Models\Information;
use Illuminate\Support\Str;

class InformationService
{
    public function createInformation(array $data, ?array $files = null): Information
    {

        $slug = Str::slug($data['title']);
        $originalSlug = $slug;
        $count = 1;
        
        while (Information::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;

        $information = Information::create([
            'title'        => $data['title'],
            'slug'        => $slug,
            'description' => $data['description'],
        ]);

        return $information;
    }

    public function updateInformation(Information $information, array $data)
    {
        $slug = Str::slug($data['title']);
        $originalSlug = $slug;
        $count = 1;
        
        while (Information::where('slug', $slug)->where('id', '!=', $information->id)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;

        $information->update($data);
    }

    public function deleteInformation(Information $information): void
    {
        $information->delete();
    }

    // --- Публичная часть ---- //
    public function getAllInformation()
    {
        return Information::paginate(12);
    }

    public function getInformationDetails(Information $information): array
    {
        return [
            'information' => $information,
        ];
    }

}