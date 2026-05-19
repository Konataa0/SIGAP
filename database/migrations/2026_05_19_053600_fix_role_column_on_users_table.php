<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Ubah kolom role menjadi string agar tidak terkunci enum lama.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role VARCHAR(20) NOT NULL DEFAULT 'mahasiswa'");

        DB::table('users')
            ->whereNull('role')
            ->update(['role' => 'mahasiswa']);
    }

    /**
     * Kembalikan ke enum standar aplikasi saat rollback.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('mahasiswa','admin','guest') NOT NULL DEFAULT 'mahasiswa'");
    }
};
