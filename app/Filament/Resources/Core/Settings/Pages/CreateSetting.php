<?php

namespace App\Filament\Resources\Core\Settings\Pages;

use App\Models\Core\Setting;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Core\Settings\SettingResource;

class CreateSetting extends CreateRecord
{
    protected static string $resource = SettingResource::class;

    protected function beforeFill(): void
    {
        if (Setting::exists()) {
            to_route('filament.management.resources.core.procedures.index');
        }
    }
}
