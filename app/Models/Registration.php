<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $table = 'registrations';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'nim',
        'angkatan',
        'pilihan_pertama',
        'alasan_pilihan_pertama',
        'pilihan_kedua',
        'alasan_pilihan_kedua',
        'foto',
    ];

    protected $casts = ['created_at' => 'datetime'];
}
