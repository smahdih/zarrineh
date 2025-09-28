<?php

namespace App\Filament\Resources\ProductManagement\Groups\ProductGroups\Pages;

use App\Filament\Resources\ProductManagement\Groups\ProductGroups\ProductGroupResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProductGroup extends EditRecord
{
    protected static string $resource = ProductGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
