<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keikutsertaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('kegiatan_id')->constrained('kegiatan')->cascadeOnDelete();
            $table->enum('status', ['berminat', 'mendaftar', 'diterima', 'selesai'])->default('berminat');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'kegiatan_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keikutsertaan');
    }
};
