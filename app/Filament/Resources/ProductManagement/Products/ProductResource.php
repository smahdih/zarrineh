<?php

namespace App\Filament\Resources\ProductManagement\Products;

use App\Filament\Resources\ProductManagement\Products\Pages\CreateProduct;
use App\Filament\Resources\ProductManagement\Products\Pages\EditProduct;
use App\Filament\Resources\ProductManagement\Products\Pages\ListProducts;
use App\Filament\Resources\ProductManagement\Products\Pages\ViewProduct;
use App\Filament\Resources\ProductManagement\Products\Schemas\ProductForm;
use App\Filament\Resources\ProductManagement\Products\Schemas\ProductInfolist;
use App\Filament\Resources\ProductManagement\Products\Tables\ProductsTable;
use App\Models\Products\Product;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = 'mdi-palette-swatch-outline';
    protected static ?string $modelLabel = 'محصول';
    protected static ?string $pluralModelLabel = 'محصول ها';
    protected static ?string $navigationLabel = 'محصول ها';

    protected static string|UnitEnum|null $navigationGroup = 'مدیریت محصول ها';
    protected static ?int $navigationSort = 1;

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProductInfolist::configure($schema);
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
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'view' => ViewProduct::route('/{record}'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }
}
