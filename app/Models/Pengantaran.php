<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengantaran extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_penyewaan', 'id_user', 'tgl_antar', 'alamat_tujuan', 'catatan_teknisi', 'status'
    ];

    protected $casts = [
        'tgl_antar' => 'date',
    ];

    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class, 'id_penyewaan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
