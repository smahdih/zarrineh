<?php

namespace App\Filament\ShopManagement\Resources\ShopUsers\Pages;

use App\Filament\ShopManagement\Resources\ShopUsers\ShopUserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListShopUsers extends ListRecords
{
    protected static string $resource = ShopUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
