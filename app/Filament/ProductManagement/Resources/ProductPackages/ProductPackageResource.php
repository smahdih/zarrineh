<?php

namespace App\Filament\ProductManagement\Resources\ProductPackages;

use App\Filament\ProductManagement\Resources\ProductPackages\Pages\CreateProductPackage;
use App\Filament\ProductManagement\Resources\ProductPackages\Pages\EditProductPackage;
use App\Filament\ProductManagement\Resources\ProductPackages\Pages\ListProductPackages;
use App\Filament\ProductManagement\Resources\ProductPackages\Schemas\ProductPackageForm;
use App\Filament\ProductManagement\Resources\ProductPackages\Tables\ProductPackagesTable;
use App\Models\Products\ProductPackage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class ProductPackageResource extends Resource
{
    protected static ?string $model = ProductPackage::class;

    protected static string|BackedEnum|null $navigationIcon = '';

    protected static string|UnitEnum|null $navigationGroup = 'مدیریت محصول ها';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return ProductPackageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductPackagesTable::configure($table);
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
            'index' => ListProductPackages::route('/'),
            'create' => CreateProductPackage::route('/create'),
            'edit' => EditProductPackage::route('/{record}/edit'),
        ];
    }
}
