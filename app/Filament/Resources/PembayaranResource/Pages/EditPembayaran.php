<?php

namespace App\Filament\Resources\PembayaranResource\Pages;

use App\Filament\Resources\PembayaranResource;
use App\Models\Penyewaan;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;

class EditPembayaran extends EditRecord
{
    protected static string $resource = PembayaranResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $oldStatus = $record->status;
        
        // Update record pembayaran
        $record->update($data);
        
        // Jika status berubah dari pending ke selesai
        if ($oldStatus === 'pending' && $data['status'] === 'selesai') {
            $this->updateStatusAfterPayment($record->id_penyewaan);
        }
        // Jika status berubah dari selesai ke pending (rollback)
        elseif ($oldStatus === 'selesai' && $data['status'] === 'pending') {
            $this->rollbackStatusAfterPayment($record->id_penyewaan);
        }

        return $record;
    }

    protected function updateStatusAfterPayment(int $penyewaanId): void
    {
        try {
            $penyewaan = Penyewaan::with('detailPenyewaans.playstation')->find($penyewaanId);
            
            if ($penyewaan) {
                $penyewaan->update(['status' => 'selesai']);
                
                foreach ($penyewaan->detailPenyewaans as $detail) {
                    $detail->playstation->update(['status' => 'tersedia']);
                }
            }

            Notification::make()
                ->title('Status diperbarui!')
                ->body('Penyewaan selesai, PlayStation kini tersedia.')
                ->success()
                ->send();

        } catch (\Exception $e) {
            Notification::make()
                ->title('Error')
                ->body('Terjadi kesalahan: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }

    protected function rollbackStatusAfterPayment(int $penyewaanId): void
    {
        try {
            $penyewaan = Penyewaan::with('detailPenyewaans.playstation')->find($penyewaanId);
            
            if ($penyewaan) {
                $penyewaan->update(['status' => 'pinjam']);
                
                foreach ($penyewaan->detailPenyewaans as $detail) {
                    $detail->playstation->update(['status' => 'dipinjam']);
                }
            }

            Notification::make()
                ->title('Status dikembalikan!')
                ->body('Penyewaan dikembalikan ke status pinjam.')
                ->warning()
                ->send();

        } catch (\Exception $e) {
            Notification::make()
                ->title('Error')
                ->body('Terjadi kesalahan: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}