<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    protected $fillable = ['nama_album', 'deskripsi', 'cover'];

    public function galeries(): HasMany
    {
        return $this->hasMany(Galery::class);
    }
}