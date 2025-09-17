<?php

namespace App\Filament\Resources\Core\Units\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class UnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make("name")
                    ->label("نام واحداندازه گیری")
                    ->required(),
                TextInput::make("symbol_en")
                    ->label("سمبل انگلیسی")
                    ->nullable(),
                TextInput::make("symbol_fa")
                    ->label("سمبل فارسی")
                    ->nullable(),
            ]);
    }
}
