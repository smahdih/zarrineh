<?php

namespace App\Filament\Resources\ProductManagement\Products\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\ForceDeleteBulkAction;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar.path_url')
                    ->label('تصویر')
                    ->visibility('public'),
                TextColumn::make('name')
                    ->label('نام محصول')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('serial')
                    ->label('سریال')
                    ->copyable()
                    ->searchable(),
                TextColumn::make('productGroup.name')->label('گروه'),
                TextColumn::make('categories.name')
                    ->label('دسته‌بندی‌ها')
                    ->badge()
                    ->listWithLineBreaks()
                    ->limitList(3),
                TextColumn::make('state')->label('وضعیت')->badge(),
                TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->jalaliDateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('تاریخ بروزرسانی')
                    ->jalaliDateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
            ])
            ->filters([TrashedFilter::make()])
            ->recordActions([ViewAction::make(), EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
