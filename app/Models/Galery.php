<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Galery extends Model
{
    protected $table = 'galeries';

    protected $fillable = ['album_id', 'judul', 'file_path', 'keterangan'];

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }
}