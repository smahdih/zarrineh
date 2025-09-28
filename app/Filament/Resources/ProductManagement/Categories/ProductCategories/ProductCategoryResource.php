<?php

namespace App\Filament\Resources\ProductManagement\Categories\ProductCategories;

use App\Filament\Resources\ProductManagement\Categories\ProductCategories\Pages\CreateProductCategory;
use App\Filament\Resources\ProductManagement\Categories\ProductCategories\Pages\EditProductCategory;
use App\Filament\Resources\ProductManagement\Categories\ProductCategories\Pages\ListProductCategories;
use App\Filament\Resources\ProductManagement\Categories\ProductCategories\Schemas\ProductCategoryForm;
use App\Filament\Resources\ProductManagement\Categories\ProductCategories\Tables\ProductCategoriesTable;
use App\Models\Products\Categories\ProductCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductCategoryResource extends Resource
{
    protected static ?string $model = ProductCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ProductCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductCategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
                //
            ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProductCategories::route('/'),
            'create' => CreateProductCategory::route('/create'),
            'edit' => EditProductCategory::route('/{record}/edit'),
        ];
    }
}
