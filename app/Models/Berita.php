<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Berita extends Model
{
    protected $fillable = [
        'tanggal', 'judul', 'isi', 'gambar', 'kategori_id', 'user_id',
    ];

    protected $casts = ['tanggal' => 'date'];

    // 1 berita milik 1 kategori
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    // 1 berita ditulis oleh 1 user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}