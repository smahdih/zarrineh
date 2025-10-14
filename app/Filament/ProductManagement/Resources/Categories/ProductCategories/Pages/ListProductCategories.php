<?php

namespace App\Filament\ProductManagement\Resources\Categories\ProductCategories\Pages;

use App\Filament\ProductManagement\Resources\Categories\ProductCategories\ProductCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductCategories extends ListRecords
{
    protected static string $resource = ProductCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
