<?php

namespace App\Filament\Resources\Core\Settings;

use App\Filament\Resources\Core\Settings\Pages\CreateSetting;
use App\Filament\Resources\Core\Settings\Pages\EditSetting;
use App\Filament\Resources\Core\Settings\Pages\ListSettings;
use App\Filament\Resources\Core\Settings\Schemas\SettingForm;
use App\Filament\Resources\Core\Settings\Tables\SettingsTable;
use App\Models\Core\Setting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $modelLabel = 'تنظیمات';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $navigationLabel = 'تنظیمات';
    protected static ?string $pluralLabel = 'تنظیمات';
    protected static string|UnitEnum|null $navigationGroup = 'مدیریت اطلاعات عمومی';

    public static function form(Schema $schema): Schema
    {
        return SettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SettingsTable::configure($table);
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
            'index' => ListSettings::route('/'),
            'create' => CreateSetting::route('/create'),
            'edit' => EditSetting::route('/{record}/edit'),
        ];
    }
}
