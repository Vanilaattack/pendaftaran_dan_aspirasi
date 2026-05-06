<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
    protected $table = 'mahasiswa';

    protected $fillable = ['nama', 'nim', 'password'];

    protected $hidden = ['password'];

    protected $casts = ['password' => 'hashed'];
}
