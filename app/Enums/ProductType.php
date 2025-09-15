<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ProductType: string implements HasLabel, HasColor
{
    case Test = "TEST";
    case Order = "ORDER";
    case Product = "PRODUCT";

    public function getLabel(): string
    {
        return match ($this) {
            self::Test => 'تست',
            self::Order => 'سفارش',
            self::Product => 'محصول',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Test => 'warning',
            self::Order => 'danger',
            self::Product => 'info',
        };
    }
}
