<?php

namespace App\Filament\Resources\ProductManagement\Categories\ProductCategories\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;

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
