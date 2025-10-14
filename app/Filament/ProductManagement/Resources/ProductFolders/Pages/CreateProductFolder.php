<?php

namespace App\Filament\ProductManagement\Resources\ProductFolders\Pages;

use App\Filament\ProductManagement\Resources\ProductFolders\ProductFolderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductFolder extends CreateRecord
{
    protected static string $resource = ProductFolderResource::class;
}
