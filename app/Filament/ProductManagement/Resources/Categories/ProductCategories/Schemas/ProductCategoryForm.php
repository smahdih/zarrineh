<?php

namespace App\Filament\ProductManagement\Resources\Categories\ProductCategories\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('نام دسته بندی')
                ->required()
                ->columnSpanFull(),
            Repeater::make('subCategories')
                ->label('زیر دسته بندی ها')
                ->addActionLabel('افزودن زیردسته بندی')
                ->relationship('subCategories')
                ->schema([TextInput::make('name')->label('نام دسته بندی')])
                ->columnSpanFull(),
        ]);
    }
}
