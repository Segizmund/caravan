<?php

namespace App\Http\Controllers\Frontend\Information;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\InformationService;
use App\Models\Information;

class InformationController extends Controller
{
    protected InformationService $informationService;

    public function __construct(InformationService $informationService)
    {
        $this->informationService = $informationService;
    }

    public function index()
    {
        $information = $this->informationService->getAllInformation(); 

        $breadcrumbs = [
            ['title' => 'Каталог информации']
        ];
        
        return view('frontend.information.catalog-information', compact('information', 'breadcrumbs'));
    }

    public function show(Information $information)
    {
        $data = $this->informationService->getInformationDetails($information);

        $data['breadcrumbs'] = [
            ['title' => 'Каталог информации', 'url' => route('information.index')],
            ['title' => $information->title]
        ];

        return view('frontend.information.show', $data);
    }
}
