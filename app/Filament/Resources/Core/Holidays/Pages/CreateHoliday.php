<?php

namespace App\Filament\Resources\Core\Holidays\Pages;

use App\Filament\Resources\Core\Holidays\HolidayResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHoliday extends CreateRecord
{
    protected static string $resource = HolidayResource::class;
}
