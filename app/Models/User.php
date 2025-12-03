<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi.
     */
    protected $fillable = [
        'username',
        'password',
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast attribute.
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed', // otomatis bcrypt
        ];
    }

    /**
     * Relasi ke Todo (jika ingin dipakai).
     */
    public function todos()
    {
        return $this->hasMany(Todo::class);
    }
}
