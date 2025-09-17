<?php

namespace App\Filament\Resources\Core\Procedures\Pages;

use App\Filament\Resources\Core\Procedures\ProcedureResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProcedures extends ListRecords
{
    protected static string $resource = ProcedureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
