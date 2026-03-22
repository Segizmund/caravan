<?php

namespace App\Services;

use App\Models\Review;
use Illuminate\Support\Facades\Storage;
use App\Traits\InteractsWithImages;

class ReviewService
{
    use InteractsWithImages;

    public function createReview(array $data, array $files = []): Review
    {
        $review = Review::create($data);

        foreach ($files as $file) {
            $path = $this->uploadImageAsWebp($file, 'reviews', 1200);
            
            $review->images()->create(['path' => $path]);
        }

        return $review;
    }

    public function toggleApproval(Review $review): void
    {
        $review->update(['is_approved' => !$review->is_approved]);
    }

    public function deleteReview(Review $review): void
    {
        foreach ($review->images as $image) {
            Storage::disk('public')->delete($image->path);
        }
        $review->delete();
    }
}