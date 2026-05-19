<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kriteria;
use App\Models\Bobot;

class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        // Jumlah semua bobot harus = 1.0
        // C1(0.35) + C2(0.25) + C3(0.20) + C4(0.20) = 1.00

        $data = [
            [
                'kode'       => 'C1',
                'nama'       => 'Kesesuaian Minat Teknis',
                'jenis'      => 'benefit',
                'keterangan' => 'Seberapa sesuai kegiatan dengan bidang teknis yang diminati mahasiswa (frontend, AI, cybersecurity, dll). Semakin sesuai semakin baik.',
                'bobot'      => 0.35,
            ],
            [
                'kode'       => 'C2',
                'nama'       => 'Relevansi Target Karir',
                'jenis'      => 'benefit',
                'keterangan' => 'Seberapa besar kegiatan ini membantu pencapaian target karir mahasiswa (developer, data scientist, security analyst, dll).',
                'bobot'      => 0.25,
            ],
            [
                'kode'       => 'C3',
                'nama'       => 'Kebutuhan Waktu Luang',
                'jenis'      => 'cost',
                'keterangan' => 'Berapa banyak waktu yang dibutuhkan kegiatan ini. Semakin sedikit waktu yang dibutuhkan, semakin cocok untuk mahasiswa yang padat jadwal.',
                'bobot'      => 0.20,
            ],
            [
                'kode'       => 'C4',
                'nama'       => 'Pengembangan Skill Praktis',
                'jenis'      => 'benefit',
                'keterangan' => 'Seberapa besar kegiatan mengembangkan skill praktis yang langsung dapat diterapkan di dunia kerja.',
                'bobot'      => 0.20,
            ],
        ];

        foreach ($data as $item) {
            $kriteria = Kriteria::create([
                'kode'       => $item['kode'],
                'nama'       => $item['nama'],
                'jenis'      => $item['jenis'],
                'keterangan' => $item['keterangan'],
            ]);

            Bobot::create([
                'kriteria_id' => $kriteria->id,
                'nilai'       => $item['bobot'],
            ]);
        }
    }
}