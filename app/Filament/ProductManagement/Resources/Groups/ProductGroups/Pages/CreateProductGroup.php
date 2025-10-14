<?php

namespace App\Filament\ProductManagement\Resources\Groups\ProductGroups\Pages;

use App\Filament\ProductManagement\Resources\Groups\ProductGroups\ProductGroupResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductGroup extends CreateRecord
{
    protected static string $resource = ProductGroupResource::class;
}
