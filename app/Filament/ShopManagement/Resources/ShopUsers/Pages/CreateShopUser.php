<?php

namespace App\Filament\ShopManagement\Resources\ShopUsers\Pages;

use App\Filament\ShopManagement\Resources\ShopUsers\ShopUserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateShopUser extends CreateRecord
{
    protected static string $resource = ShopUserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['password'] = bcrypt($data['national_id']);

        return $data;
    }
}