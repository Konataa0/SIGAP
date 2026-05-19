<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bobot', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteria_id')
                  ->constrained('kriteria')
                  ->onDelete('cascade');
            $table->decimal('nilai', 5, 4);
            // nilai antara 0.0000 – 1.0000
            // jumlah semua bobot sebaiknya = 1.0000
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bobot');
    }
};