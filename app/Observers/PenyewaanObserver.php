<?php

namespace App\Observers;

use App\Models\Penyewaan;
use App\Models\Pengantaran;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class PenyewaanObserver
{
    /**
     * Handle the Penyewaan "created" event.
     */
    public function created(Penyewaan $penyewaan): void
    {
        Log::info("Observer CREATED called for Penyewaan ID: {$penyewaan->id}, Status: {$penyewaan->status}");
        
        // Otomatis buat pengantaran jika status penyewaan adalah "pinjam"
        if ($penyewaan->status === 'pinjam') {
            Log::info("Status is 'pinjam', attempting to create pengantaran");
            $this->createPengantaran($penyewaan);
        }
    }

    /**
     * Handle the Penyewaan "updated" event.
     */
    public function updated(Penyewaan $penyewaan): void
    {
        $originalStatus = $penyewaan->getOriginal('status');
        $currentStatus = $penyewaan->status;
        
        Log::info("Observer UPDATED called for Penyewaan ID: {$penyewaan->id}, Original Status: {$originalStatus}, Current Status: {$currentStatus}");
        
        // Jika status berubah menjadi "pinjam" dan belum ada pengantaran
        if ($currentStatus === 'pinjam' && 
            $originalStatus !== 'pinjam' && 
            !$penyewaan->pengantaran) {
            Log::info("Status changed to 'pinjam', attempting to create pengantaran");
            $this->createPengantaran($penyewaan);
        }
        
        // Jika status berubah dari "pinjam" ke status lain, hapus pengantaran yang masih proses
        if ($originalStatus === 'pinjam' && 
            $currentStatus !== 'pinjam' && 
            $penyewaan->pengantaran && 
            $penyewaan->pengantaran->status === 'proses') {
            
            Log::info("Status changed from 'pinjam', deleting pengantaran");
            // Hapus pengantaran yang belum selesai jika penyewaan dibatalkan
            $penyewaan->pengantaran->delete();
        }
    }

    /**
     * Create pengantaran record
     */
    private function createPengantaran(Penyewaan $penyewaan): void
    {
        Log::info("createPengantaran called for Penyewaan ID: {$penyewaan->id}");
        
        // Cek apakah sudah ada pengantaran untuk penyewaan ini
        $existingPengantaran = Pengantaran::where('id_penyewaan', $penyewaan->id)->first();
        if ($existingPengantaran) {
            Log::warning("Pengantaran already exists for Penyewaan ID: {$penyewaan->id}, skipping creation");
            return;
        }

        // Refresh penyewaan untuk memastikan relationship terbaru
        $penyewaan->refresh();
        if ($penyewaan->pengantaran) {
            Log::warning("Pengantaran relationship exists for Penyewaan ID: {$penyewaan->id}, skipping creation");
            return;
        }

        // Ambil teknisi default
        $defaultUser = User::where('role', 'teknisi')->first() ?? User::first();
        
        if (!$defaultUser) {
            Log::error('Tidak ada user yang tersedia untuk dijadikan teknisi');
            return;
        }
        
        try {
            Log::info("Creating pengantaran for Penyewaan ID: {$penyewaan->id}");
            
            $pengantaran = Pengantaran::create([
                'id_penyewaan' => $penyewaan->id,
                'id_user' => $defaultUser->id,
                'tgl_antar' => $penyewaan->tgl_sewa,
                'alamat_tujuan' => $penyewaan->alamat,
                'catatan_teknisi' => null,
                'status' => 'proses'
            ]);
            
            Log::info("Pengantaran created successfully with ID: {$pengantaran->id}");
            
        } catch (\Exception $e) {
            Log::error('Gagal membuat pengantaran: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
        }
    }

    /**
     * Handle the Penyewaan "deleted" event.
     */
    public function deleted(Penyewaan $penyewaan): void
    {
        // Hapus pengantaran terkait jika penyewaan dihapus
        if ($penyewaan->pengantaran) {
            $penyewaan->pengantaran->delete();
        }
    }
}