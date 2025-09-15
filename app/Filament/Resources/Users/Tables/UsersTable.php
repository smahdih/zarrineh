<?php

namespace App\Filament\Resources\Users\Tables;

use App\Filament\Resources\Users\UserResource;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('profile_photo_path')
                    ->label('')
                    ->circular()
                    ->searchable(),
                TextColumn::make('personal_id')
                    ->label('کد پرسنلی')
                    ->searchable(),
                TextColumn::make(name: 'first_name')
                    ->label('نام')
                    ->searchable(),
                TextColumn::make(name: 'last_name')
                    ->label('نام خانوادگی')
                    ->searchable(),
                TextColumn::make('gender')
                    ->label('جنسیت')
                    ->badge()
                    ->searchable(),
                TextColumn::make('national_id')
                    ->label('کد ملی')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('phone')
                    ->label('شماره همراه')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('آدرس ایمیل')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make(name: 'is_active')
                    ->label('وضعیت دسترسی')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('تاریخ بروزرسانی')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()->hiddenLabel(),
                EditAction::make()->hiddenLabel(),
                UserResource::blockAction(),
                UserResource::activateAction(),
                UserResource::resetPasswordAction(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                ]),
            ]);
    }
}