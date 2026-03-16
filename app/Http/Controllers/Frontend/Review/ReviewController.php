<?php

namespace App\Http\Controllers\Frontend;

use App\Services\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'author_name'     => 'required|string|max:255',
            'email'           => 'required|email',
            'comment'         => 'required|string',
            'rating'          => 'required|integer|between:1,5',
            'reviewable_id'   => 'required|integer',
            'reviewable_type' => 'required|string',
            'images'          => 'array|max:3',
            'images.*'        => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $this->reviewService->createReview($validated, $request->file('images', []));

        return redirect()->back()->with('success', 'Отзыв отправлен!');
    }
}
