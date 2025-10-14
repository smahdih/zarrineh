<?php

namespace App\Filament\ProductManagement\Resources\Products;

use App\Filament\ProductManagement\Resources\Products\Pages\CreateProduct;
use App\Filament\ProductManagement\Resources\Products\Pages\EditProduct;
use App\Filament\ProductManagement\Resources\Products\Pages\ListProducts;
use App\Filament\ProductManagement\Resources\Products\Pages\ViewProduct;
use App\Filament\ProductManagement\Resources\Products\Schemas\ProductInfolist;
use App\Filament\ProductManagement\Resources\Products\Tables\ProductsTable;
use App\Models\Products\Product;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = '';
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
