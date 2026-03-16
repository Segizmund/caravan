<?php

namespace App\Services;

use Illuminate\Support\Str;

class SlugService
{
    public static function generate(string $name, string $modelClass, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        $query = $modelClass::where('slug', $slug);
        if ($ignoreId) $query->where('id', '!=', $ignoreId);

        while ($query->exists()) {
            $slug = $originalSlug . '-' . $count++;
            $query = $modelClass::where('slug', $slug);
            if ($ignoreId) $query->where('id', '!=', $ignoreId);
        }

        return $slug;
    }
}