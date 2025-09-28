<?php

namespace App\Filament\Resources\ProductManagement\Groups\ProductGroups;

use App\Filament\Resources\ProductManagement\Groups\ProductGroups\Pages\CreateProductGroup;
use App\Filament\Resources\ProductManagement\Groups\ProductGroups\Pages\EditProductGroup;
use App\Filament\Resources\ProductManagement\Groups\ProductGroups\Pages\ListProductGroups;
use App\Filament\Resources\ProductManagement\Groups\ProductGroups\Schemas\ProductGroupForm;
use App\Filament\Resources\ProductManagement\Groups\ProductGroups\Tables\ProductGroupsTable;
use App\Models\Products\Groups\ProductGroup;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductGroupResource extends Resource
{
    protected static ?string $model = ProductGroup::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ProductGroupForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductGroupsTable::configure($table);
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
            'index' => ListProductGroups::route('/'),
            'create' => CreateProductGroup::route('/create'),
            'edit' => EditProductGroup::route('/{record}/edit'),
        ];
    }
}
