<?php

namespace App\Filament\Resources\ProductManagement\ProductPackages\Pages;

use App\Filament\Resources\ProductManagement\ProductPackages\ProductPackageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductPackages extends ListRecords
{
    protected static string $resource = ProductPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
