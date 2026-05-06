<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin default
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name'     => 'Admin Himpunan',
                'email'    => 'admin@himpunan.local',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}
