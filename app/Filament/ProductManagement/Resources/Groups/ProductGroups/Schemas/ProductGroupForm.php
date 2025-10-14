<?php

namespace App\Filament\ProductManagement\Resources\Groups\ProductGroups\Schemas;

use App\Models\Core\Unit;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductGroupForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('نام گروه کالا')
                ->required()
                ->columnSpan(1),
            Repeater::make('details')
                ->label('خصوصیات مرتبط با کالا')
                ->addActionLabel('افزودن خصوصیت')
                ->relationship('details')
                ->defaultItems(0)
                ->schema([
                    TextInput::make('name')
                        ->label('نام خصوصیت کالا')
                        ->columnSpan(3),
                    Select::make('unit')
                        ->label('واحد اندازه گیری')
                        ->relationship('unit')
                        ->options(fn() => Unit::all()->pluck('name', 'id'))
                        ->columnSpan(2),
                ])
                ->columns(5)
                ->columnSpan(2),
        ]);
    }
}
