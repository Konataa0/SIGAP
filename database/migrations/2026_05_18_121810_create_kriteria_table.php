<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kriteria', function (Blueprint $table) {
            $table->id();
            $table->string('nama');           // contoh: "Kesesuaian Minat Teknis"
            $table->string('kode')->unique(); // contoh: "C1"
            $table->enum('jenis', ['benefit', 'cost']);
            // benefit = semakin tinggi semakin baik
            // cost    = semakin rendah semakin baik
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kriteria');
    }
};