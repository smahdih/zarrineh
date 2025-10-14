<?php

namespace App\Filament\ProductManagement\Resources\ProductPackages\Pages;

use App\Filament\ProductManagement\Resources\ProductPackages\ProductPackageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductPackage extends CreateRecord
{
    protected static string $resource = ProductPackageResource::class;
}
