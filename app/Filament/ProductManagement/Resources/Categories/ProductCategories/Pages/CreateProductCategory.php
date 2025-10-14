<?php

namespace App\Filament\ProductManagement\Resources\Categories\ProductCategories\Pages;

use App\Filament\ProductManagement\Resources\Categories\ProductCategories\ProductCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductCategory extends CreateRecord
{
    protected static string $resource = ProductCategoryResource::class;
}
