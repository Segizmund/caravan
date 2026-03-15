<?php
namespace App\Services;

use App\Models\Setting;

class SettingsService
{
    public function getSettings(): Setting
    {
        return Setting::find(1) ?? new Setting();
    }

    public function updateSettings(array $data): void
    {
        Setting::updateOrCreate(
            ['id' => 1],
            $data
        );
    }
}