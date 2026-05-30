<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Buat akun Admin default ───────────────────────────────────────────
        User::create([
            'name'     => 'Admin SIGAP',
            'email'    => 'admin@sigap.test',
            'password' => bcrypt('password'),
            'role'     => 'admin',
            'nim'      => null,
            'jurusan'  => null,
            'angkatan' => null,
        ]);

        // ── Buat akun Mahasiswa contoh ────────────────────────────────────────
        User::create([
            'name'     => 'Mahasiswa Demo',
            'email'    => 'mahasiswa@sigap.test',
            'password' => bcrypt('password'),
            'role'     => 'mahasiswa',
            'nim'      => '23010101',
            'jurusan'  => 'Teknik Informatika',
            'angkatan' => '2023',
        ]);

        // ── Jalankan seeder data ──────────────────────────────────────────────
        // Urutan PENTING: kriteria dulu sebelum nilai_kegiatan
        $this->call([
            KriteriaSeeder::class,       // ← dulu
            KegiatanSeeder::class,       // ← dulu
            NilaiKegiatanSeeder::class,  // ← terakhir (butuh kegiatan & kriteria)
        ]);
    }
}