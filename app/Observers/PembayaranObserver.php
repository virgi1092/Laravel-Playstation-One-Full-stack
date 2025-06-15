<?php

namespace App\Observers;

use App\Models\Pembayaran;
use Illuminate\Support\Facades\Log;

class PembayaranObserver
{
    /**
     * Handle the Pembayaran "created" event.
     */
    public function created(Pembayaran $pembayaran): void
    {
        Log::info('PembayaranObserver: created event triggered', [
            'pembayaran_id' => $pembayaran->id,
            'status' => $pembayaran->status
        ]);

        // Ketika pembayaran dibuat dengan status pending
        // Status penyewaan berubah menjadi 'proses' dan stok berkurang
        if ($pembayaran->status === 'pending') {
            $this->handlePendingPayment($pembayaran);
        }
        
        // Jika langsung dibuat dengan status selesai
        if ($pembayaran->status === 'selesai') {
            $this->handleCompletedPayment($pembayaran);
        }
    }

    /**
     * Handle the Pembayaran "updated" event.
     */
    public function updated(Pembayaran $pembayaran): void
    {
        Log::info('PembayaranObserver: updated event triggered', [
            'pembayaran_id' => $pembayaran->id,
            'old_status' => $pembayaran->getOriginal('status'),
            'new_status' => $pembayaran->status
        ]);

        $oldStatus = $pembayaran->getOriginal('status');
        $newStatus = $pembayaran->status;

        // Jika status berubah dari pending ke selesai
        if ($oldStatus === 'pending' && $newStatus === 'selesai') {
            $this->handlePaymentCompleted($pembayaran);
        }
        
        // Jika status berubah dari selesai ke pending (rollback)
        if ($oldStatus === 'selesai' && $newStatus === 'pending') {
            $this->handlePaymentRollback($pembayaran);
        }
    }

    /**
     * Handle the Pembayaran "deleted" event.
     */
    public function deleted(Pembayaran $pembayaran): void
    {
        Log::info('PembayaranObserver: deleted event triggered', [
            'pembayaran_id' => $pembayaran->id,
            'status' => $pembayaran->status
        ]);

        $this->handlePaymentDeletion($pembayaran);
    }

    /**
     * Handle the Pembayaran "restored" event.
     */
    public function restored(Pembayaran $pembayaran): void
    {
        Log::info('PembayaranObserver: restored event triggered');
        
        // Terapkan kembali logika sesuai status
        if ($pembayaran->status === 'pending') {
            $this->handlePendingPayment($pembayaran);
        } elseif ($pembayaran->status === 'selesai') {
            $this->handleCompletedPayment($pembayaran);
        }
    }

    /**
     * Handle pembayaran dengan status pending
     */
    private function handlePendingPayment(Pembayaran $pembayaran): void
    {
        $penyewaan = $pembayaran->penyewaan;
        
        if (!$penyewaan) {
            Log::warning('Penyewaan not found for pembayaran', ['pembayaran_id' => $pembayaran->id]);
            return;
        }

        // Update status penyewaan dari 'pinjam' ke 'proses'
        if ($penyewaan->status === 'pinjam') {
            $penyewaan->update(['status' => 'proses']);
            Log::info('Penyewaan status updated to proses', ['penyewaan_id' => $penyewaan->id]);
            
            // Kurangi stok PlayStation
            $this->decreasePlaystationStock($penyewaan);
        }
    }

    /**
     * Handle pembayaran langsung selesai
     */
    private function handleCompletedPayment(Pembayaran $pembayaran): void
    {
        $penyewaan = $pembayaran->penyewaan;
        
        if (!$penyewaan) {
            Log::warning('Penyewaan not found for pembayaran', ['pembayaran_id' => $pembayaran->id]);
            return;
        }

        // Jika dari pinjam langsung ke selesai
        if ($penyewaan->status === 'pinjam') {
            $penyewaan->update(['status' => 'kembali']);
            Log::info('Penyewaan status updated to kembali (direct)', ['penyewaan_id' => $penyewaan->id]);
        }
        // Jika dari proses ke selesai
        elseif ($penyewaan->status === 'proses') {
            $penyewaan->update(['status' => 'kembali']);
            Log::info('Penyewaan status updated to kembali', ['penyewaan_id' => $penyewaan->id]);
            
            // Kembalikan stok PlayStation
            $this->increasePlaystationStock($penyewaan);
        }
    }

    /**
     * Handle perubahan status dari pending ke selesai
     */
    private function handlePaymentCompleted(Pembayaran $pembayaran): void
    {
        $penyewaan = $pembayaran->penyewaan;
        
        if (!$penyewaan) {
            Log::warning('Penyewaan not found for pembayaran', ['pembayaran_id' => $pembayaran->id]);
            return;
        }

        // Update status penyewaan dari 'proses' ke 'kembali'
        if ($penyewaan->status === 'proses') {
            $penyewaan->update(['status' => 'kembali']);
            Log::info('Penyewaan status updated to kembali', ['penyewaan_id' => $penyewaan->id]);
            
            // Kembalikan stok PlayStation
            $this->increasePlaystationStock($penyewaan);
        }
    }

    /**
     * Handle rollback dari selesai ke pending
     */
    private function handlePaymentRollback(Pembayaran $pembayaran): void
    {
        $penyewaan = $pembayaran->penyewaan;
        
        if (!$penyewaan) {
            Log::warning('Penyewaan not found for pembayaran', ['pembayaran_id' => $pembayaran->id]);
            return;
        }

        // Update status penyewaan dari 'kembali' kembali ke 'proses'
        if ($penyewaan->status === 'kembali') {
            $penyewaan->update(['status' => 'proses']);
            Log::info('Penyewaan status rolled back to proses', ['penyewaan_id' => $penyewaan->id]);
            
            // Kurangi lagi stok PlayStation (karena sebelumnya sudah dikembalikan)
            $this->decreasePlaystationStock($penyewaan);
        }
    }

    /**
     * Handle penghapusan pembayaran
     */
    private function handlePaymentDeletion(Pembayaran $pembayaran): void
    {
        $penyewaan = $pembayaran->penyewaan;
        
        if (!$penyewaan) {
            Log::warning('Penyewaan not found for deleted pembayaran', ['pembayaran_id' => $pembayaran->id]);
            return;
        }

        // Jika pembayaran yang dihapus statusnya pending atau selesai
        if (in_array($pembayaran->status, ['pending', 'selesai'])) {
            // Kembalikan status penyewaan ke 'pinjam'
            $penyewaan->update(['status' => 'pinjam']);
            Log::info('Penyewaan status restored to pinjam', ['penyewaan_id' => $penyewaan->id]);
            
            // Kembalikan stok PlayStation
            $this->increasePlaystationStock($penyewaan);
        }
    }

    /**
     * Kurangi stok PlayStation berdasarkan detail penyewaan
     */
    private function decreasePlaystationStock($penyewaan): void
    {
        foreach ($penyewaan->detailPenyewaans as $detail) {
            $playstation = $detail->playstation;
            
            if (!$playstation) {
                Log::warning('PlayStation not found for detail', ['detail_id' => $detail->id]);
                continue;
            }

            // Cek apakah stok mencukupi
            if ($playstation->stok >= $detail->jumlah) {
                $oldStock = $playstation->stok;
                $playstation->decrement('stok', $detail->jumlah);
                
                Log::info('PlayStation stock decreased', [
                    'playstation_id' => $playstation->id,
                    'nama_playstation' => $playstation->nama_playstation,
                    'old_stock' => $oldStock,
                    'decreased_by' => $detail->jumlah,
                    'new_stock' => $playstation->fresh()->stok
                ]);
            } else {
                Log::error('Insufficient PlayStation stock', [
                    'playstation_id' => $playstation->id,
                    'nama_playstation' => $playstation->nama_playstation,
                    'current_stock' => $playstation->stok,
                    'required' => $detail->jumlah
                ]);
                
                // Opsional: Throw exception atau handle error
                throw new \Exception("Stok PlayStation {$playstation->nama_playstation} tidak mencukupi. Stok tersedia: {$playstation->stok}, dibutuhkan: {$detail->jumlah}");
            }
        }
    }

    /**
     * Tambah stok PlayStation berdasarkan detail penyewaan
     */
    private function increasePlaystationStock($penyewaan): void
    {
        foreach ($penyewaan->detailPenyewaans as $detail) {
            $playstation = $detail->playstation;
            
            if (!$playstation) {
                Log::warning('PlayStation not found for detail', ['detail_id' => $detail->id]);
                continue;
            }

            $oldStock = $playstation->stok;
            $playstation->increment('stok', $detail->jumlah);
            
            Log::info('PlayStation stock increased', [
                'playstation_id' => $playstation->id,
                'nama_playstation' => $playstation->nama_playstation,
                'old_stock' => $oldStock,
                'increased_by' => $detail->jumlah,
                'new_stock' => $playstation->fresh()->stok
            ]);
        }
    }
}