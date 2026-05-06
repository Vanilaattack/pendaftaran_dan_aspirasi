<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
    protected $table = 'aspirations';

    public $timestamps = false;

    protected $fillable = ['nama_pengirim', 'judul', 'isi_aspirasi'];

    protected $casts = ['created_at' => 'datetime'];
}
