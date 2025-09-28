<?php

namespace App\Filament\Resources\ProductManagement\ProductPackages;

use App\Filament\Resources\ProductManagement\ProductPackages\Pages\CreateProductPackage;
use App\Filament\Resources\ProductManagement\ProductPackages\Pages\EditProductPackage;
use App\Filament\Resources\ProductManagement\ProductPackages\Pages\ListProductPackages;
use App\Filament\Resources\ProductManagement\ProductPackages\Schemas\ProductPackageForm;
use App\Filament\Resources\ProductManagement\ProductPackages\Tables\ProductPackagesTable;
use App\Models\Products\ProductPackage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductPackageResource extends Resource
{
    protected static ?string $model = ProductPackage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

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