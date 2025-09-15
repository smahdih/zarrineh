<?php

namespace App\Filament\Resources\Users;

use UnitEnum;
use BackedEnum;
use App\Models\User;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Hash;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ViewUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Filament\Resources\Users\Schemas\UserInfolist;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $modelLabel = "کارمند";
    protected static ?string $pluralLabel = "کارمند ها";

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $recordTitleAttribute = 'Users';

    protected static string | UnitEnum | null $navigationGroup = 'پرسنلی';

    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UserInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'view' => ViewUser::route('/{record}'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }

        public static function blockAction(): Action
    {
        return Action::make(name: 'block')
            ->label('بستن دسترسی')
            ->color('danger')
            ->requiresConfirmation()
            ->icon('heroicon-o-lock-closed')
            ->action(function ($record) {
                $record->is_active = false;
                $record->save();
            })
            ->visible(fn ($record) => $record->is_active);
    }

    public static function activateAction(): Action
    {
        return Action::make('activate')
            ->label('بازکردن دسترسی')
            ->color(color: 'success')
            ->requiresConfirmation()
            ->icon('heroicon-o-lock-open')
            ->action(function ($record) {
                $record->is_active = true;
                $record->save();
            })
            ->visible(fn ($record) => !$record->is_active);
    }

    public static function resetPasswordAction(): Action
    {
        return Action::make('reset_password')
            ->label('بازنشانی رمز ورود')
            ->color('primary')
            ->requiresConfirmation()
            ->icon('heroicon-o-arrow-path')
            ->action(function ($record) {
                $record->password = Hash::make($record->national_id);
                $record->save();
            });
    }
}
