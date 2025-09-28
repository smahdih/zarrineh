<?php

namespace App\Filament\Resources\ProductManagement\Groups\ProductGroups\Pages;

use App\Filament\Resources\ProductManagement\Groups\ProductGroups\ProductGroupResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductGroup extends CreateRecord
{
    protected static string $resource = ProductGroupResource::class;
}
