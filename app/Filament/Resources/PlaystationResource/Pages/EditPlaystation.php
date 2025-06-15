<?php

namespace App\Filament\Resources\PlaystationResource\Pages;

use App\Filament\Resources\PlaystationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlaystation extends EditRecord
{
    protected static string $resource = PlaystationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
