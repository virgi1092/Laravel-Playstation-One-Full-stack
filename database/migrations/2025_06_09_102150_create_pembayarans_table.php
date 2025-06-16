<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('pby_id')->unique(); // Hapus ->after('id')
            $table->foreignId('id_penyewaan')->constrained('penyewaans')->onDelete('cascade');
            $table->integer('jumlah_bayar');
            $table->enum('metode_bayar', ['Tunai', 'E-Wallet', 'Transfer']);
            $table->boolean('is_paid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};