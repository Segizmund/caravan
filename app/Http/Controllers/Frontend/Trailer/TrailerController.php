<?php

namespace App\Http\Controllers\Frontend\Trailer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TrailerService;
use App\Models\Trailer;

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

        $breadcrumbs = [
            ['title' => 'Каталог прицепов']
        ];
        
        return view('frontend.trailers.catalog-trailers', compact('categories', 'breadcrumbs'));
    }

    public function loadMore(Request $request, $categoryId)
    {
        $page = $request->input('page', 1);
        $trailers = $this->trailerService->getTrailersByCategoryIdPaginated($categoryId, $page);

        return view('frontend.partials.trailer-list', compact('trailers'))->render();
    }

    public function show(Trailer $trailer)
    {

        $data = $this->trailerService->getTrailerDetails($trailer);

        $data['breadcrumbs'] = [
            ['title' => 'Каталог прицепов', 'url' => route('trailer.index')],
            ['title' => $trailer->name]
        ];

        return view('frontend.trailers.show', $data);
    }
}
