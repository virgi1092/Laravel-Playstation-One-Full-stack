<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Model;

class Playstation extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_playstation', 'jenis', 'harga_sewa_harian', 'stok', 'foto_playstation'
    ];

    protected $casts = [
        'harga_sewa_harian' => MoneyCast::class,
    ];

    public function detailPenyewaans()
    {
        return $this->hasMany(DetailPenyewaan::class, 'id_playstation');
    }
}

