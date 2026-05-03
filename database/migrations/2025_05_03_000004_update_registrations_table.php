<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            // Hapus kolom lama
            $table->dropColumn(['program_studi', 'alasan_bergabung']);
        });

        Schema::table('registrations', function (Blueprint $table) {
            // Tambah kolom baru
            $table->string('angkatan')->nullable()->after('nim');
            $table->string('pilihan_pertama')->nullable()->after('angkatan');
            $table->text('alasan_memilih_pilihan_pertama')->nullable()->after('pilihan_pertama');
            $table->string('pilihan_kedua')->nullable()->after('alasan_memilih_pilihan_pertama');
            $table->text('alasan_memilih_pilihan_kedua')->nullable()->after('pilihan_kedua');
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn([
                'angkatan',
                'pilihan_pertama',
                'alasan_memilih_pilihan_pertama',
                'pilihan_kedua',
                'alasan_memilih_pilihan_kedua',
            ]);
        });

        Schema::table('registrations', function (Blueprint $table) {
            $table->string('program_studi')->nullable()->after('nim');
            $table->text('alasan_bergabung')->nullable()->after('program_studi');
        });
    }
};
