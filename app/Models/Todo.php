<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    // Kolom yang bisa diisi
    protected $fillable = [
        'user_id',
        'title',
        'is_done',
    ];

    // Cast tipe data
    protected $casts = [
        'is_done' => 'boolean',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope: hanya task milik user tertentu
    public function scopeOwnedBy($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
