<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SettingsService;
use App\Models\Setting;

class SettingController extends Controller
{
    protected $settingsService;

    public function __construct(SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    public function index()
    {
        $settings = $this->settingsService->getSettings();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'first_phone'   => 'nullable|string|max:20',
            'second_phone' => 'nullable|string|max:20',
            'email'          => 'nullable|email|max:255',
            'address'       => 'nullable|string|max:50',
        ]);

        $this->settingsService->updateSettings($validated);

        return redirect()->route('admin.settings.index')->with('success', 'Настройки обновлены!');
    }

}
