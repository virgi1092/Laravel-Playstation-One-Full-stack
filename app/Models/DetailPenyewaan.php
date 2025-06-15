<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Model;

class DetailPenyewaan extends Model
{
    protected $fillable = [
        'id_penyewaan', 'id_playstation', 'jumlah', 'durasi_sewa','total_harga'
    ];
    protected $casts = [
        'total_harga' => MoneyCast::class,
    ];

    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class, 'id_penyewaan');
    }

    public function playstation()
    {
        return $this->belongsTo(Playstation::class, 'id_playstation');
    }
}
