<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum HolidayType: string implements HasLabel
{
    case National = 'national';
    case Company = 'company';
    case Custom = 'custom';

    public function getLabel(): string
    {
        return match ($this) {
            self::National => 'ملی',
            self::Company => 'شرکتی',
            self::Custom => 'سفارشی',
        };
    }
}
