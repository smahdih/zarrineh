<?php

namespace App\Filament\Resources\ProductManagement\Products\Pages;

use App\Filament\Resources\ProductManagement\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
}
