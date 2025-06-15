<?php

use App\Models\Penyewa;
use App\Models\Playstation;
use App\Models\User;
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
        Schema::create('penyewaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penyewa')->constrained('penyewas')->onDelete('cascade');
            $table->date('tgl_pesan');
            $table->date('tgl_sewa');
            $table->date('tgl_kembali');
            $table->string('alamat')->nullable();
            $table->string('no_telpon')->nullable();
            $table->text('ulasan')->nullable();
            $table->enum('jaminan', ['Ktp', 'Stnk', 'Ijazah', 'Sim'])->nullable();
            $table->text('foto_jaminan')->nullable();
            $table->enum('status',['pinjam','proses','kembali']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewaans');
    }
};
