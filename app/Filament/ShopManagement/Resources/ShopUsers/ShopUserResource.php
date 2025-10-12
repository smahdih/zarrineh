<?php

namespace App\Filament\ShopManagement\Resources\ShopUsers;

use BackedEnum;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use Modules\ResellersPanel\Models\ShopUser;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\ShopManagement\Resources\ShopUsers\Pages\EditShopUser;
use App\Filament\ShopManagement\Resources\ShopUsers\Pages\ListShopUsers;
use App\Filament\ShopManagement\Resources\ShopUsers\Pages\CreateShopUser;
use App\Filament\ShopManagement\Resources\ShopUsers\Schemas\ShopUserForm;
use App\Filament\ShopManagement\Resources\ShopUsers\Tables\ShopUsersTable;
use UnitEnum;

class ShopUserResource extends Resource
{
    protected static ?string $model = ShopUser::class;

    protected static ?string $modelLabel = 'کارمند';
    protected static ?string $pluralLabel = 'کارمند ها';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $recordTitleAttribute = 'Users';

    protected static string|UnitEnum|null $navigationGroup = 'پرسنلی';

    public static function form(Schema $schema): Schema
    {
        return ShopUserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ShopUsersTable::configure($table);
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
            'index' => ListShopUsers::route('/'),
            'create' => CreateShopUser::route('/create'),
            'edit' => EditShopUser::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()->withoutGlobalScopes(
            [SoftDeletingScope::class],
        );
    }
}
