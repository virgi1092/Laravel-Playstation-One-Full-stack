<?php

namespace App\Filament\Resources\PenyewaanResource\Pages;

use App\Filament\Resources\PenyewaanResource;
use App\Filament\Widgets\LaporanPenyewaanWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenyewaan extends ListRecords
{
    protected static string $resource = PenyewaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
