<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengumuman extends Model
{
    // Ditulis eksplisit karena Laravel menebak nama tabelnya "pengumumen"
    protected $table = 'pengumumen';

    protected $fillable = ['judul', 'isi', 'lampiran', 'status', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Untuk halaman publik: hanya yang berstatus published
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }
}