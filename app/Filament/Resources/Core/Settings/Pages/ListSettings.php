<?php

namespace App\Filament\Resources\Core\Settings\Pages;

use App\Models\Core\Setting;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Core\Settings\SettingResource;

class ListSettings extends ListRecords
{
    protected static string $resource = SettingResource::class;

    protected function getHeaderActions(): array
    {
        if (Setting::exists()) {
            return [];
        }

        return [
            CreateAction::make(),
        ];
    }
}
