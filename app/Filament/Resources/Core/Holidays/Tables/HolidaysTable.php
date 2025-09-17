<?php

namespace App\Filament\Resources\Core\Holidays\Tables;

use App\Enums\HolidayType;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class HolidaysTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')
                    ->label('تاریخ')
                    ->jalaliDate()
                    ->sortable(),
                TextColumn::make('event')
                    ->label('عنوان')
                    ->searchable(),
                TextColumn::make('type')
                    ->label('نوع')
                    ->formatStateUsing(fn ($state) => HolidayType::tryFrom($state)?->getLabel() ?? $state)
                    ->searchable(),
                TextColumn::make('team_id')
                    ->label('تیم')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_manual')
                    ->label('تعطیلی سفارشی')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->jalaliDateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('تاریخ بروزرسانی')
                    ->jalaliDateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
