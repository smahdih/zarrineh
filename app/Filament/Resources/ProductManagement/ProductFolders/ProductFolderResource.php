<?php

namespace App\Filament\Resources\ProductManagement\ProductFolders;

use App\Filament\Resources\ProductManagement\ProductFolders\Pages\CreateProductFolder;
use App\Filament\Resources\ProductManagement\ProductFolders\Pages\EditProductFolder;
use App\Filament\Resources\ProductManagement\ProductFolders\Pages\ListProductFolders;
use App\Filament\Resources\ProductManagement\ProductFolders\Schemas\ProductFolderForm;
use App\Filament\Resources\ProductManagement\ProductFolders\Tables\ProductFoldersTable;
use App\Models\Products\ProductFolder;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductFolderResource extends Resource
{
    protected static ?string $model = ProductFolder::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

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
