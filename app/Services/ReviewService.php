<?php

namespace App\Services;

use App\Models\Review;
use Illuminate\Support\Facades\Storage;

class ReviewService
{
    public function createReview(array $data, array $files = []): Review
    {
        $review = Review::create($data);

        foreach ($files as $file) {
            $path = $file->store('reviews', 'public');
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