<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Penyewa extends Authenticatable
{

    use HasFactory, Notifiable;
    protected $table = 'penyewas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email','password'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // public function setPasswordAttribute($value)
    // {
    //     if (!empty($value)) {
    //         $this->attributes['password'] = \Illuminate\Support\Facades\Hash::make($value);
    //     }
    // }

    public function penyewaans()
    {
        return $this->hasMany(Penyewaan::class, 'id_penyewa');
    }
}
