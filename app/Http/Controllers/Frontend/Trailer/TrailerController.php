<?php

namespace App\Http\Controllers\Frontend\Trailer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TrailerService;

class TrailerController extends Controller
{    
    protected $trailerService;
    
    public function __construct(TrailerService $trailerService)
    {
        $this->trailerService = $trailerService;
    }

    public function index()
    {
        $categories = $this->trailerService->getPaginatedTrailersGrouped(3);
        
        return view('frontend.catalog-trailers', compact('categories'));
    }
    public function loadMore(Request $request, $categoryId)
    {
        $page = $request->input('page', 1);
        $trailers = $this->trailerService->getTrailersByCategoryIdPaginated($categoryId, $page);

        return view('frontend.partials.trailer-list', compact('trailers'))->render();
    }
}
