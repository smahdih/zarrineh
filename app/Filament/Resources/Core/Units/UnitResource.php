<?php

namespace App\Filament\Resources\Core\Units;

use App\Filament\Resources\Core\Units\Pages\CreateUnit;
use App\Filament\Resources\Core\Units\Pages\EditUnit;
use App\Filament\Resources\Core\Units\Pages\ListUnits;
use App\Filament\Resources\Core\Units\Schemas\UnitForm;
use App\Filament\Resources\Core\Units\Tables\UnitsTable;
use App\Models\Core\Unit;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class UnitResource extends Resource
{
    protected static ?string $model = Unit::class;
    protected static ?string $modelLabel = 'واحد اندازه گیری';
    protected static ?string $pluralModelLabel = 'واحد های اندازه گیری';
    protected static string|BackedEnum|null $navigationIcon = 'css-ruler';
    protected static ?string $navigationLabel = 'واحد های اندازه گیری';
    protected static string|UnitEnum|null $navigationGroup = 'مدیریت اطلاعات عمومی';

    public static function form(Schema $schema): Schema
    {
        return UnitForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UnitsTable::configure($table);
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
            'index' => ListUnits::route('/'),
            'create' => CreateUnit::route('/create'),
            'edit' => EditUnit::route('/{record}/edit'),
        ];
    }
}
