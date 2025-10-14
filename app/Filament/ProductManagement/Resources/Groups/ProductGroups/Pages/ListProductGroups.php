<?php

namespace App\Filament\ProductManagement\Resources\Groups\ProductGroups\Pages;

use App\Filament\ProductManagement\Resources\Groups\ProductGroups\ProductGroupResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductGroups extends ListRecords
{
    protected static string $resource = ProductGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
