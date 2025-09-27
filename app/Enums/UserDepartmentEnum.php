<?php

namespace App\Enums;

enum UserDepartmentEnum: string
{
    case PRODUCTION = 'PRODUCTION';
    case SALES = 'SALES';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PRODUCTION => 'تولید',
            self::SALES => 'فروش',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PRODUCTION => 'info',
            self::SALES => 'primary',
        };
    }
}
