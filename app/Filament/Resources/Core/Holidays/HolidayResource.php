<?php

namespace App\Filament\Resources\Core\Holidays;

use App\Filament\Resources\Core\Holidays\Pages\CreateHoliday;
use App\Filament\Resources\Core\Holidays\Pages\EditHoliday;
use App\Filament\Resources\Core\Holidays\Pages\ListHolidays;
use App\Filament\Resources\Core\Holidays\Schemas\HolidayForm;
use App\Filament\Resources\Core\Holidays\Tables\HolidaysTable;
use App\Models\Core\Holiday;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class HolidayResource extends Resource
{
    protected static ?string $model = Holiday::class;
    protected static ?string $modelLabel = 'تعطیلات';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendar;
    protected static ?string $navigationLabel = 'تعطیلات';
    protected static ?string $pluralLabel = 'تعطیلات';
    protected static string|UnitEnum|null $navigationGroup = 'مدیریت اطلاعات عمومی';

    public static function form(Schema $schema): Schema
    {
        return HolidayForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HolidaysTable::configure($table);
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
            'index' => ListHolidays::route('/'),
            'create' => CreateHoliday::route('/create'),
            'edit' => EditHoliday::route('/{record}/edit'),
        ];
    }
}
