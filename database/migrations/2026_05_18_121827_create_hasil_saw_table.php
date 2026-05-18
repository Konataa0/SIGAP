<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_saw', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->foreignId('kegiatan_id')
                  ->constrained('kegiatan')
                  ->onDelete('cascade');
            $table->decimal('skor', 8, 6);
            // skor SAW ternormalisasi: 0.000000 – 1.000000
            $table->integer('ranking');
            // preferensi input mahasiswa yang menghasilkan skor ini (disimpan JSON)
            $table->json('input_preferensi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_saw');
    }
};