<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'pby_id',        // TAMBAHKAN INI
        'id_penyewaan',
        'jumlah_bayar',
        'metode_bayar',
        'status',
        'is_paid'         // TAMBAHKAN INI
    ];
    protected $attributes = [
        'is_paid' => false,
    ];
    protected $casts = [
        'jumlah_bayar' => MoneyCast::class,
        'is_paid' => 'boolean', // PERBAIKI DARI 'jumlah_harga'
    ];

    // Event boot untuk otomatis generate pby_id
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->pby_id)) {
                $model->pby_id = self::generateUniquePbyId();
            }
        });
    }

    public static function generateUniquePbyId()
    {
        $prefix = "PBY";
        do {
            $randomString = $prefix . mt_rand(1000, 9999);
        } while (self::where('pby_id', $randomString)->exists());

        return $randomString;
    }

    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class, 'id_penyewaan');
    }
}
