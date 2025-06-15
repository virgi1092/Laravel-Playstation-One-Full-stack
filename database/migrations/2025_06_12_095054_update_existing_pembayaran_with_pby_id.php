<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Pembayaran;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing records yang belum memiliki pby_id
        $pembayarans = Pembayaran::whereNull('pby_id')->orWhere('pby_id', '')->get();
        
        foreach ($pembayarans as $pembayaran) {
            $pembayaran->pby_id = Pembayaran::generateUniquePbyId();
            $pembayaran->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak ada rollback diperlukan
    }
};