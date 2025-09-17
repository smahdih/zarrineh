<?php

namespace App\Filament\Resources\Core\Holidays\Schemas;

use App\Enums\HolidayType;
use Filament\Schemas\Schema;
use App\Models\Organization\Team;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;

class HolidayForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('date')
                    ->label('تاریخ')
                    ->jalali()
                    ->required(),
                TextInput::make('event')
                    ->label('عنوان'),
                Select::make('type')
                    ->label('نوع')
                    ->options(HolidayType::class)
                    ->required(),
                Toggle::make('is_manual')
                    ->label('تعطیلی سفارشی')
                    ->required(),
                Select::make('team_id')
                    ->label('تیم')
                    ->options(Team::all()->pluck('name', 'id'))
                    ->required(),
            ]);
    }
}
