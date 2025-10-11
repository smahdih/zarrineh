<?php

namespace App\Filament\ShopManagement\Resources\ShopUsers\Schemas;

use Filament\Schemas\Schema;
use App\Enums\UserGenderEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class ShopUserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            FileUpload::make('profile_photo_path')
                ->label('تصویر پروفایل')
                ->image()
                ->avatar()
                ->imageEditor()
                ->directory('profile-photos')
                ->columnSpanFull(),
            TextInput::make('first_name')->label('نام')->required(),
            TextInput::make('last_name')->label('نام خانوادگی')->required(),
            Select::make('gender')
                ->label('جنسیت')
                ->options(UserGenderEnum::class)
                ->required(),
            TextInput::make('national_id')
                ->label('شماره ملی')
                ->unique()
                ->required(),
            TextInput::make('phone')
                ->label('شماره موبایل')
                ->unique()
                ->tel()
                ->required(),
            TextInput::make('email')->label('آدرس ایمیل')->email()->unique(),
            Textarea::make('address')->label('آدرس')->columnSpanFull(),
        ]);
    }
}
