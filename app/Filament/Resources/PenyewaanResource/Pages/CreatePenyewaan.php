<?php

namespace App\Filament\Resources\PenyewaanResource\Pages;

use App\Filament\Resources\PenyewaanResource;
use App\Models\Playstation;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreatePenyewaan extends CreateRecord
{
    protected static string $resource = PenyewaanResource::class;
}
// class CreatePenyewaan extends CreateRecord
// {
//     protected static string $resource = PenyewaanResource::class;

//     protected function getRedirectUrl(): string
//     {
//         return $this->getResource()::getUrl('index');
//     }

//     protected function mutateFormDataBeforeCreate(array $data): array
//     {
//         // Validasi stok sebelum membuat record
//         $this->validateStock($data);
        
//         // Set tanggal pesan jika belum ada
//         if (!isset($data['tgl_pesan'])) {
//             $data['tgl_pesan'] = now();
//         }

//         return $data;
//     }

//     protected function afterCreate(): void
//     {
//         Notification::make()
//             ->title('Penyewaan berhasil dibuat')
//             ->success()
//             ->send();
//     }

//     private function validateStock(array $data): void
//     {
//         if (!isset($data['detailPenyewaans'])) {
//             return;
//         }

//         foreach ($data['detailPenyewaans'] as $detail) {
//             if (!isset($detail['id_playstation']) || !isset($detail['jumlah'])) {
//                 continue;
//             }

//             $playstation = Playstation::find($detail['id_playstation']);
            
//             if (!$playstation) {
//                 throw new \Exception("PlayStation tidak ditemukan.");
//             }

//             if ($detail['jumlah'] > $playstation->stok) {
//                 throw new \Exception("Stok {$playstation->nama_playstation} tidak mencukupi. Stok tersedia: {$playstation->stok}, diminta: {$detail['jumlah']}");
//             }
//         }
//     }
// }