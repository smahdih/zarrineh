<?php

namespace App\Filament\ProductManagement\Resources\ProductFolders\Pages;

use App\Filament\ProductManagement\Resources\ProductFolders\ProductFolderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductFolders extends ListRecords
{
    protected static string $resource = ProductFolderResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
