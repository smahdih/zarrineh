<?php

namespace App\Filament\ProductManagement\Resources\ProductPackages\Pages;

use App\Filament\ProductManagement\Resources\ProductPackages\ProductPackageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProductPackage extends EditRecord
{
    protected static string $resource = ProductPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
