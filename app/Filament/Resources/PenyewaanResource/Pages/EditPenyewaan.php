<?php

namespace App\Filament\Resources\PenyewaanResource\Pages;

use App\Filament\Resources\PenyewaanResource;
use App\Models\Playstation;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditPenyewaan extends EditRecord
{
    protected static string $resource = PenyewaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
// class EditPenyewaan extends EditRecord
// {
//     protected static string $resource = PenyewaanResource::class;

//     protected function getHeaderActions(): array
//     {
//         return [
//             Actions\ViewAction::make(),
//             Actions\DeleteAction::make(),
//         ];
//     }

//     protected function getRedirectUrl(): string
//     {
//         return $this->getResource()::getUrl('index');
//     }

//     protected function mutateFormDataBeforeSave(array $data): array
//     {
//         // Validasi stok jika ada perubahan pada detail penyewaan
//         $this->validateStockChanges($data);
        
//         return $data;
//     }

//     protected function afterSave(): void
//     {
//         Notification::make()
//             ->title('Penyewaan berhasil diperbarui')
//             ->success()
//             ->send();
//     }

//     private function validateStockChanges(array $data): void
//     {
//         if (!isset($data['detailPenyewaans'])) {
//             return;
//         }

//         $originalRecord = $this->getRecord();
//         $originalDetails = $originalRecord->detailPenyewaans->keyBy('id_playstation');

//         foreach ($data['detailPenyewaans'] as $detail) {
//             if (!isset($detail['id_playstation']) || !isset($detail['jumlah'])) {
//                 continue;
//             }

//             $playstation = Playstation::find($detail['id_playstation']);
            
//             if (!$playstation) {
//                 continue;
//             }

//             // Hitung perubahan jumlah
//             $originalDetail = $originalDetails->get($detail['id_playstation']);
//             $originalJumlah = $originalDetail ? $originalDetail->jumlah : 0;
//             $selisih = $detail['jumlah'] - $originalJumlah;

//             // Jika ada penambahan dan status adalah 'proses'
//             if ($selisih > 0 && $data['status'] === 'proses') {
//                 if ($selisih > $playstation->stok) {
//                     throw new \Exception("Stok {$playstation->nama_playstation} tidak mencukupi untuk penambahan. Stok tersedia: {$playstation->stok}, diminta tambahan: {$selisih}");
//                 }
//             }
//         }
//     }
// }