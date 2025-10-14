<?php

namespace App\Filament\ProductManagement\Resources\Groups\ProductGroups\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductGroupsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([TextColumn::make('name')->label('نام گروه کالا')])
            ->filters([
                //
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
