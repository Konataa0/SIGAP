<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel ini menyimpan nilai tiap kegiatan untuk tiap kriteria.
     * Inilah "matriks keputusan" yang dipakai algoritma SAW.
     *
     * Contoh isi:
     *  kegiatan_id=1 (UKM Robotika), kriteria_id=1 (Minat Teknis), nilai=4
     *  kegiatan_id=1 (UKM Robotika), kriteria_id=2 (Target Karir),  nilai=3
     */
    public function up(): void
    {
        Schema::create('nilai_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')
                  ->constrained('kegiatan')
                  ->onDelete('cascade');
            $table->foreignId('kriteria_id')
                  ->constrained('kriteria')
                  ->onDelete('cascade');
            $table->decimal('nilai', 5, 2);
            // skala 1–5 (bisa disesuaikan tim)
            $table->unique(['kegiatan_id', 'kriteria_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai_kegiatan');
    }
};