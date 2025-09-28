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
use UnitEnum;

class ProductCategoryResource extends Resource
{
    protected static ?string $model = ProductCategory::class;
    protected static ?string $modelLabel = 'دسته بندی محصول';
    protected static ?string $pluralModelLabel = 'دسته بندی های محصول';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;
    protected static ?string $navigationLabel = 'دسته بندی';
    protected static string|UnitEnum|null $navigationGroup = 'مدیریت محصول ها';
    protected static ?int $navigationSort = 6;

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
