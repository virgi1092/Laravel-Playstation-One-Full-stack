<?php

namespace App\Filament\Resources\PengantaranResource\Pages;

use App\Filament\Resources\PengantaranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengantaran extends EditRecord
{
    protected static string $resource = PengantaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Remove delete action untuk keamanan
            // Actions\DeleteAction::make(),
            
            Actions\Action::make('complete_delivery')
                ->label('Selesaikan Pengantaran')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->visible(fn () => $this->record->status === 'proses')
                ->action(function () {
                    $this->record->update(['status' => 'selesai']);
                    
                    // Update status penyewaan menjadi 'proses' setelah berhasil diantar
                    $this->record->penyewaan->update(['status' => 'proses']);
                    
                    // Notification
                    \Filament\Notifications\Notification::make()
                        ->title('Pengantaran berhasil diselesaikan')
                        ->success()
                        ->send();
                        
                    return redirect($this->getResource()::getUrl('index'));
                }),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}