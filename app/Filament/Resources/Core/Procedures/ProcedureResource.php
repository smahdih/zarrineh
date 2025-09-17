<?php

namespace App\Filament\Resources\Core\Procedures;

use App\Filament\Resources\Core\Procedures\Pages\CreateProcedure;
use App\Filament\Resources\Core\Procedures\Pages\EditProcedure;
use App\Filament\Resources\Core\Procedures\Pages\ListProcedures;
use App\Filament\Resources\Core\Procedures\Schemas\ProcedureForm;
use App\Filament\Resources\Core\Procedures\Tables\ProceduresTable;
use App\Models\Core\Procedure;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProcedureResource extends Resource
{
    protected static ?string $model = Procedure::class;
    protected static ?string $modelLabel = "روند کاری";
    protected static ?string $pluralModelLabel = "روندهای کاری";
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $navigationLabel = "روندهای کاری";
    protected static string | UnitEnum | null $navigationGroup = "مدیریت تولید";
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return ProcedureForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProceduresTable::configure($table);
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
            'index' => ListProcedures::route('/'),
            'create' => CreateProcedure::route('/create'),
            'edit' => EditProcedure::route('/{record}/edit'),
        ];
    }
}
