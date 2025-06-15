<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('penyewaans', function (Blueprint $table) {
            // Tambahkan kolom jika belum ada
            if (!Schema::hasColumn('penyewaans', 'tgl_pesan')) {
                $table->date('tgl_pesan')->after('id_penyewa');
            }
        });
    }

    public function down()
    {
        Schema::table('penyewaans', function (Blueprint $table) {
            $table->dropColumn(['tgl_pesan']);
        });
    }
};