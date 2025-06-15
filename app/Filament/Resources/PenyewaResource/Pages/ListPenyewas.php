<?php

namespace App\Filament\Resources\PenyewaResource\Pages;

use App\Filament\Resources\PenyewaResource;
use App\Filament\Widgets\LaporanPenyewaanWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenyewas extends ListRecords
{
    protected static string $resource = PenyewaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
