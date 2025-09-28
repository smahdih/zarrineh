<?php

namespace App\Filament\Resources\ProductManagement\ProductPackages\Pages;

use App\Filament\Resources\ProductManagement\ProductPackages\ProductPackageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductPackage extends CreateRecord
{
    protected static string $resource = ProductPackageResource::class;
}
