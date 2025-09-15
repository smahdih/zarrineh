<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ProcedureTypeEnum: string implements HasLabel, HasColor
{
    case PRODUCE = "PRODUCE";
    case TEST = "TEST";

    public function getLabel(): string
    {
        return match ($this) {
            self::PRODUCE => "تولید",
            self::TEST => "تست",
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::PRODUCE => "success",
            self::TEST => "warning",
        };
    }
}
