<?php

namespace App\Filament\Resources\ProductManagement\ProductFolders\Pages;

use App\Filament\Resources\ProductManagement\ProductFolders\ProductFolderResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProductFolder extends EditRecord
{
    protected static string $resource = ProductFolderResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
