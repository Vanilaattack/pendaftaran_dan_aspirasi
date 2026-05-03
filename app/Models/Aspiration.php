<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nama_pengirim',
        'judul_aspirasi',
        'pesan',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
