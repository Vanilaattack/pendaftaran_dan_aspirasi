<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nim');
            $table->string('angkatan');
            $table->string('pilihan_pertama');
            $table->text('alasan_pilihan_pertama');
            $table->string('pilihan_kedua');
            $table->text('alasan_pilihan_kedua');
            $table->string('foto')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
