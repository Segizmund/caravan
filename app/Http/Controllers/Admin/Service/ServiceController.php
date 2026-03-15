<?php

namespace App\Http\Controllers\Admin\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\ServiceService;
use App\Models\Service;

class ServiceController extends Controller
{
    protected $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $services = Service::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();

        $hasSearchQuery = $request->has('search') && !empty($search);

        return view('admin.services.index', compact('services', 'search', 'hasSearchQuery'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request, ServiceService $serviceService)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'photos.*'    => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $serviceService->createService(
            $request->only(['name', 'description']), 
            $request->file('photos')
        );

        return redirect()->route('admin.services.index')->with('success', 'Услуга добавлена!');
    }

    public function edit(Service $service)
    {
        $service->load('images');
        return view('admin.services.create', compact('service'));
    }

    public function update(Request $request, Service $service, ServiceService $serviceService)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'photos.*'    => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'remove_images' => 'nullable|array',
        ]);

        $serviceService->updateService(
            $service,
            $request->only(['name', 'description']),
            $request->file('photos'),
            $request->input('remove_images', [])
        );

        return redirect()->route('admin.services.index')->with('success', 'Услуга обновлена!');
    }
    public function destroy($id, ServiceService $serviceService)
    {
        $service = Service::findOrFail($id);
        
        $serviceService->deleteService($service);

        return redirect()->back()->with('success', 'Категория и все её изображения успешно удалены!');
    }
}
