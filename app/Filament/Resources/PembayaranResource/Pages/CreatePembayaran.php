<?php

namespace App\Filament\Resources\PembayaranResource\Pages;

use App\Filament\Resources\PembayaranResource;
use App\Models\Penyewaan;
use App\Models\Playstation;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;

class CreatePembayaran extends CreateRecord
{
    protected static string $resource = PembayaranResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        // Set is_paid berdasarkan status atau kondisi lain
        $data['is_paid'] = ($data['status'] ?? '') === 'selesai';
        // Buat record pembayaran
        $pembayaran = static::getModel()::create($data);

        // Jika status pembayaran selesai, update status penyewaan dan PlayStation
        if ($data['status'] === 'selesai') {
            $this->updateStatusAfterPayment($data['id_penyewaan']);
        }

        return $pembayaran;
    }

    protected function updateStatusAfterPayment(int $penyewaanId): void
    {
        try {
            // Update status penyewaan menjadi selesai
            $penyewaan = Penyewaan::with('detailPenyewaans.playstation')->find($penyewaanId);

            if ($penyewaan) {
                $penyewaan->update(['status' => 'selesai']);

                // Update status PlayStation kembali menjadi tersedia
                foreach ($penyewaan->detailPenyewaans as $detail) {
                    $detail->playstation->update(['status' => 'tersedia']);
                }
            }

            Notification::make()
                ->title('Pembayaran berhasil!')
                ->body('Status penyewaan dan PlayStation telah diperbarui.')
                ->success()
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->title('Error')
                ->body('Terjadi kesalahan saat memperbarui status: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Pembayaran berhasil dibuat!';
    }
    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     // Set default is_paid jika tidak ada
    //     if (!isset($data['is_paid'])) {
    //         $data['is_paid'] = false;
    //     }

    //     return $data;
    // }
}
