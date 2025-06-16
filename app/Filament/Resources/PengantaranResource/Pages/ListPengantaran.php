<?php

// File: app/Filament/Resources/PengantaranResource/Pages/ListPengantaran.php

namespace App\Filament\Resources\PengantaranResource\Pages;

use App\Filament\Resources\PengantaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengantaran extends ListRecords
{
    protected static string $resource = PengantaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Remove create action karena record otomatis terbuat
            // Actions\CreateAction::make(),
        ];
    }
    
    protected function getHeaderWidgets(): array
    {
        return [
            // Bisa tambahkan widget untuk statistik pengantaran
        ];
    }
}