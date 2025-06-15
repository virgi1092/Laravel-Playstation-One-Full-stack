<?php

namespace App\Filament\Resources\PengantaranResource\Pages;

use App\Filament\Resources\PengantaranResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePengantaran extends CreateRecord
{
    protected static string $resource = PengantaranResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
