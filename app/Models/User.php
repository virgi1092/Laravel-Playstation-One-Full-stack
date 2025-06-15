<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'id';

    protected $fillable = [
        'email','email_verified_at', 'password', 'name', 'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function pengantarans()
    {
        return $this->hasMany(Pengantaran::class, 'id_user');
    }
}
