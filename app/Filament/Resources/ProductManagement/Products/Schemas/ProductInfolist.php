<?php

namespace App\Filament\Resources\ProductManagement\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            ImageEntry::make('avatar.path')
                ->label('تصویر محصول')
                ->hiddenLabel()
                ->columnSpanFull(),
            Section::make([
                TextEntry::make('serial')->label('سریال')->copyable(),
                TextEntry::make('name')->label('نام محصول'),
                TextEntry::make('user.name')->label('طراح'),
                TextEntry::make('folder.serial')->label('کد پوشه'),
            ])->columns(5),
            RepeatableEntry::make('variants')
                ->label('سایز ها')
                ->schema([
                    TextEntry::make('serial')->label('سریال')->copyable(),
                    TextEntry::make('width')->label('عرض'),
                    TextEntry::make('height')->label('طول'),
                ])
                ->columnSpanFull()
                ->columns(3),
            ImageEntry::make('pictures.path')
                ->label('تصویر محصول')
                ->columnSpanFull()
                ->hiddenLabel(),
        ]);
    }
}
