<?php

namespace App\Filament\Resources\Core\Settings\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make("minimum_output")->label(
                    "حداقل خروجی"
                ),
                TextInput::make("maximum_output")->label(
                    "حداکثر خروجی"
                ),
            ]);
    }
}
