<?php

namespace App\Filament\Resources\Core\Units\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class UnitsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('نام واحداندازه گیری')
                    ->searchable(),
                TextColumn::make('symbol_en')
                    ->label('سمبل انگلیسی')
                    ->searchable(),
                TextColumn::make('symbol_fa')
                    ->label('سمبل فارسی')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
