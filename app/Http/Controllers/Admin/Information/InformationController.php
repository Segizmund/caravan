<?php

namespace App\Http\Controllers\Admin\Information;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\InformationService;
use App\Models\Information;
use Illuminate\Support\Str;

class InformationController extends Controller
{
    protected $informationService;

    public function __construct(InformationService $informationService)
    {
        $this->informationService = $informationService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $information = Information::query()
            ->when($search, fn($q) => $q->where('title', 'like', "%{$search}%"))
            ->latest()
        ->get();

        $hasSearchQuery = $request->has('search') && !empty($search);

        return view('admin.information.index', compact('information', 'search', 'hasSearchQuery'));
    }

    public function create()
    {
        return view('admin.information.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $this->informationService->createInformation($validated);

        return redirect()->route('admin.information.index')->with('success', 'Информация успешно создана!');
    }

    public function edit(Information $information)
    {
        return view('admin.information.create', compact('information'));
    }

    public function update(Request $request, Information $information)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $this->informationService->updateInformation($information, $validated);

        return redirect()->route('admin.information.index')->with('success', 'Информация обновлена!');
    }

    public function destroy($id)
    {
        $information = Information::findOrFail($id);
        
        $this->informationService->deleteInformation($information);

        return redirect()->back()->with('success', 'Информация успешно удалена!');
    }
}