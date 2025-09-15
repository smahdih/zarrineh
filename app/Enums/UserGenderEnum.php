<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum UserGenderEnum: string implements HasColor, HasLabel
{
    case MALE = "MALE";
    case FEMALE = "FEMALE";

    public function getLabel(): ?string
    {
        return match ($this) {
            self::MALE => "مرد",
            self::FEMALE => "زن",
        };
    }

    public function adjective(): string
    {
        return match ($this) {
            self::MALE => "آقا",
            self::FEMALE => "خانم",
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::MALE => "primary",
            self::FEMALE => "success",
        };
    }
}
