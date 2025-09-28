<?php

namespace App\Filament\Resources\ProductManagement\Categories\ProductCategories\Pages;

use App\Filament\Resources\ProductManagement\Categories\ProductCategories\ProductCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductCategory extends CreateRecord
{
    protected static string $resource = ProductCategoryResource::class;
}
