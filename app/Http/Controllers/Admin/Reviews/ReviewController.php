<?php

namespace App\Http\Controllers\Admin\Reviews;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Services\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function index()
    {
        // Загружаем отзывы с их родительскими моделями (прицеп/услуга)
        $reviews = Review::with('reviewable')->latest()->paginate(20);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function toggle(Review $review)
    {
        $this->reviewService->toggleApproval($review);
        return back()->with('success', 'Статус отзыва изменен');
    }

    public function destroy(Review $review)
    {
        $this->reviewService->deleteReview($review);
        return back()->with('success', 'Отзыв удален');
    }
}
