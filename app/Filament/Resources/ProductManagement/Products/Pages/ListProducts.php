<?php

namespace App\Filament\Resources\ProductManagement\Products\Pages;

use App\Filament\Resources\ProductManagement\Products\ProductResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
