<?php

namespace App\Filament\ProductManagement\Resources\ProductFolders;

use App\Filament\ProductManagement\Resources\ProductFolders\Pages\CreateProductFolder;
use App\Filament\ProductManagement\Resources\ProductFolders\Pages\EditProductFolder;
use App\Filament\ProductManagement\Resources\ProductFolders\Pages\ListProductFolders;
use App\Filament\ProductManagement\Resources\ProductFolders\Schemas\ProductFolderForm;
use App\Filament\ProductManagement\Resources\ProductFolders\Tables\ProductFoldersTable;
use App\Models\Products\ProductFolder;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class ProductFolderResource extends Resource
{
    protected static ?string $model = ProductFolder::class;

    protected static string|BackedEnum|null $navigationIcon = '';

    protected static string|UnitEnum|null $navigationGroup = 'مدیریت محصول ها';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return ProductFolderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductFoldersTable::configure($table);
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
            'index' => ListProductFolders::route('/'),
            'create' => CreateProductFolder::route('/create'),
            'edit' => EditProductFolder::route('/{record}/edit'),
        ];
    }
}
