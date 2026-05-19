<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NilaiKegiatan;
use App\Models\Kegiatan;
use App\Models\Kriteria;

class NilaiKegiatanSeeder extends Seeder
{
    /**
     * Skala nilai: 1 (sangat rendah) – 5 (sangat tinggi)
     *
     * Kolom:
     *   C1 = Kesesuaian Minat Teknis   (benefit)
     *   C2 = Relevansi Target Karir    (benefit)
     *   C3 = Kebutuhan Waktu Luang     (cost)    ← semakin rendah = semakin ringan
     *   C4 = Pengembangan Skill Praktis (benefit)
     */
    public function run(): void
    {
        // Format: ['nama kegiatan' => [C1, C2, C3, C4]]
        $matriksNilai = [
            'UKM Robotika'                      => [4, 3, 4, 4],
            'UKM Cyber Security'                 => [5, 4, 4, 5],
            'UKM Pengembangan Aplikasi'          => [5, 5, 4, 5],
            'UKM Kecerdasan Buatan'              => [5, 4, 4, 5],
            'Hackathon Nasional Kemahasiswaan'   => [4, 5, 2, 4],
            'Lomba CTF (Capture The Flag)'       => [5, 4, 2, 4],
            'Kompetisi Data Science Kaggle'      => [4, 5, 2, 4],
            'GEMASTIK (Pagelaran Mahasiswa TIK)' => [4, 5, 2, 5],
            'AWS Certified Cloud Practitioner'   => [3, 5, 3, 4],
            'Google Associate Android Developer' => [4, 5, 3, 5],
            'TensorFlow Developer Certificate'   => [5, 5, 3, 5],
            'CompTIA Security+'                  => [4, 5, 3, 4],
        ];

        // Ambil semua kriteria dan buat mapping kode → id
        $kriteriaMap = Kriteria::pluck('id', 'kode')->toArray();
        // Contoh: ['C1' => 1, 'C2' => 2, 'C3' => 3, 'C4' => 4]

        $kodeUrut = ['C1', 'C2', 'C3', 'C4'];

        foreach ($matriksNilai as $namaKegiatan => $nilaiArr) {
            $kegiatan = Kegiatan::where('nama', $namaKegiatan)->first();

            if (!$kegiatan) {
                continue; // skip kalau nama tidak ketemu
            }

            foreach ($kodeUrut as $index => $kode) {
                if (!isset($kriteriaMap[$kode])) continue;

                NilaiKegiatan::updateOrCreate(
                    [
                        'kegiatan_id' => $kegiatan->id,
                        'kriteria_id' => $kriteriaMap[$kode],
                    ],
                    [
                        'nilai' => $nilaiArr[$index],
                    ]
                );
            }
        }
    }
}