<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_penyewa',
        'tgl_pesan',
        'tgl_sewa',
        'tgl_kembali',
        'status',
        'alamat',
        'no_telpon',
        'ulasan',
        'jaminan',
        'foto_jaminan'
    ];

    protected $casts = [
        'tgl_pesan' => 'date',
        'tgl_sewa' => 'date',
        'tgl_kembali' => 'date',
    ];

    // File: app/Models/Penyewaan.php
    // Tambahkan method boot() ini ke dalam Model Penyewaan yang sudah ada

   
    
    public function penyewa()
    {
        return $this->belongsTo(Penyewa::class, 'id_penyewa');
    }

    public function detailPenyewaans()
    {
        return $this->hasMany(DetailPenyewaan::class, 'id_penyewaan');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_penyewaan');
    }

    public function pengantarans()
    {
        return $this->hasMany(Pengantaran::class, 'id_penyewaan');
    }
}
