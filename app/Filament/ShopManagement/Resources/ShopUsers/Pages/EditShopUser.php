<?php

namespace App\Filament\ShopManagement\Resources\ShopUsers\Pages;

use App\Filament\ShopManagement\Resources\ShopUsers\ShopUserResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditShopUser extends EditRecord
{
    protected static string $resource = ShopUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
