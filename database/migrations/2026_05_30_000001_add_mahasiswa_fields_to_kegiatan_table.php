<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            $table->text('syarat_ketentuan')->nullable()->after('gambar');
            $table->date('deadline_pendaftaran')->nullable()->after('syarat_ketentuan');
            $table->string('link_pendaftaran')->nullable()->after('deadline_pendaftaran');
            $table->string('kontak_pic')->nullable()->after('link_pendaftaran');
        });
    }

    public function down(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            $table->dropColumn([
                'syarat_ketentuan',
                'deadline_pendaftaran',
                'link_pendaftaran',
                'kontak_pic',
            ]);
        });
    }
};
