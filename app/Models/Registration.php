<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nama_lengkap',
        'nim',
        'angkatan',
        'pilihan_pertama',
        'alasan_memilih_pilihan_pertama',
        'pilihan_kedua',
        'alasan_memilih_pilihan_kedua',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
