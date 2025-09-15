<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ProductState: string implements HasLabel, HasColor
{
    case Draft = "DRAFT";
    case Active = "ACTIVE";
    case Archived = "ARCHIVED";

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Draft => 'پیش نویس',
            self::Active => 'قعال',
            self::Archived => 'بایگانی',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Draft => 'info',
            self::Active => 'success',
            self::Archived => 'warning',
        };
    }
}
