<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Components\Utilities\Get;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('profile_photo_path')
                    ->label('تصویر پروفایل')
                    ->circular()
                    ->columnSpanFull(),
                TextEntry::make('personal_id')->label('کد پرسنلی'),
                TextEntry::make('first_name')->label('نام'),
                TextEntry::make('last_name')->label('نام خانوادگی'),
                TextEntry::make('gender')->label('جنسیت')->badge(),
                TextEntry::make('national_id')->label('شماره ملی'),
                TextEntry::make('phone')->label('شماره موبایل'),
                TextEntry::make('email')->label('ایمیل آدرس')->placeholder('-'),
                TextEntry::make('address')
                    ->label('آدرس')
                    ->placeholder('-')
                    ->columnSpanFull(),
                IconEntry::make('is_active')
                    ->label(label: 'وضعیت دسترسی')
                    ->boolean(),
            ])
            ->columns(4);
    }
}
