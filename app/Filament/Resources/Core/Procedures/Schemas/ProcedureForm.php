<?php

namespace App\Filament\Resources\Core\Procedures\Schemas;

use Filament\Schemas\Schema;
use App\Enums\ProcedureTypeEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;

class ProcedureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make("name")
                    ->label("نام")
                    ->required()
                    ->maxLength(255),
                Select::make("type")
                    ->label("نوع")
                    ->options(ProcedureTypeEnum::class)
                    ->required(),
                Fieldset::make("تیم ها")->schema([
                    Repeater::make("sectionFlows")
                        ->label("")
                        ->addActionLabel("افزودن تیم")
                        ->relationship("sectionFlows")
                        ->schema([
                            TextInput::make("level")
                                ->label("مرحله")
                                ->numeric()
                                ->required()
                                ->columnSpan(1),
                            Select::make("team_id")
                                ->label("تیم")
                                ->required()
                                ->relationship("section", "name")
                                ->preload()
                                ->columnSpan(4),
                        ])
                        ->columnSpanFull()
                        ->columns(5),
                ]),
            ]);
    }
}
