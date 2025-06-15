<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tambahkan 'selesai' ke enum status penyewaans
        DB::statement("ALTER TABLE penyewaans MODIFY COLUMN status ENUM('pinjam', 'proses', 'kembali', 'selesai') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke enum awal
        DB::statement("ALTER TABLE penyewaans MODIFY COLUMN status ENUM('pinjam', 'proses', 'kembali') NOT NULL");
    }
};