<?php

namespace App\Filament\Resources\ProductManagement\Categories\ProductCategories\Pages;

use App\Filament\Resources\ProductManagement\Categories\ProductCategories\ProductCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProductCategory extends EditRecord
{
    protected static string $resource = ProductCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
