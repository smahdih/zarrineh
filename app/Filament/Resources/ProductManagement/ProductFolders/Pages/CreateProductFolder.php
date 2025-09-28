<?php

namespace App\Filament\Resources\ProductManagement\ProductFolders\Pages;

use App\Filament\Resources\ProductManagement\ProductFolders\ProductFolderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductFolder extends CreateRecord
{
    protected static string $resource = ProductFolderResource::class;
}
