<?php

namespace App\Filament\ProductManagement\Resources\Groups\ProductGroups\Pages;

use App\Filament\ProductManagement\Resources\Groups\ProductGroups\ProductGroupResource;
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
