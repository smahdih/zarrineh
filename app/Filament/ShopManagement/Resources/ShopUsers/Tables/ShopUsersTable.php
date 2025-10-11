<?php

namespace App\Filament\ShopManagement\Resources\ShopUsers\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\ForceDeleteBulkAction;

class ShopUsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('profile_photo_path')
                    ->label('')
                    ->circular()
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
                TextColumn::make('phone')->label('شماره همراه')->searchable(),
                TextColumn::make('email')
                    ->label('آدرس ایمیل')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make(name: 'is_owner')
                    ->label('مالک')
                    ->boolean()
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
            ->filters([TrashedFilter::make()])
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
