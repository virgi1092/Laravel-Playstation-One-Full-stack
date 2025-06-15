<?php

namespace App\Filament\Resources\PlaystationResource\Pages;

use App\Filament\Resources\PlaystationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPlaystations extends ListRecords
{
    protected static string $resource = PlaystationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
