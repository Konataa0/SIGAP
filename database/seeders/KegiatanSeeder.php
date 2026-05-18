<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kegiatan;

class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // ── UKM ──────────────────────────────────────────────────────────
            [
                'nama'          => 'UKM Robotika',
                'jenis'         => 'ukm',
                'deskripsi'     => 'Unit kegiatan mahasiswa yang berfokus pada pengembangan robot, sistem embedded, dan IoT. Cocok untuk mahasiswa yang menyukai hardware dan programming rendah.',
                'penyelenggara' => 'BEM Fakultas',
            ],
            [
                'nama'          => 'UKM Cyber Security',
                'jenis'         => 'ukm',
                'deskripsi'     => 'Komunitas mahasiswa yang mempelajari keamanan siber, ethical hacking, dan forensik digital. Aktif mengikuti kompetisi CTF.',
                'penyelenggara' => 'BEM Fakultas',
            ],
            [
                'nama'          => 'UKM Pengembangan Aplikasi',
                'jenis'         => 'ukm',
                'deskripsi'     => 'UKM yang fokus pada pengembangan aplikasi web dan mobile. Mengerjakan proyek nyata untuk masyarakat dan startup.',
                'penyelenggara' => 'BEM Fakultas',
            ],
            [
                'nama'          => 'UKM Kecerdasan Buatan',
                'jenis'         => 'ukm',
                'deskripsi'     => 'UKM yang membahas machine learning, deep learning, dan data science. Aktif dalam riset dan kompetisi AI.',
                'penyelenggara' => 'Himpunan Mahasiswa',
            ],
            // ── Lomba ─────────────────────────────────────────────────────────
            [
                'nama'          => 'Hackathon Nasional Kemahasiswaan',
                'jenis'         => 'lomba',
                'deskripsi'     => 'Kompetisi sprint 24-48 jam membangun produk digital. Berhadiah dan membuka peluang magang di perusahaan teknologi nasional.',
                'penyelenggara' => 'Kemendikbud',
            ],
            [
                'nama'          => 'Lomba CTF (Capture The Flag)',
                'jenis'         => 'lomba',
                'deskripsi'     => 'Kompetisi keamanan siber berbasis tantangan. Peserta memecahkan soal kriptografi, reverse engineering, dan web exploitation.',
                'penyelenggara' => 'BSSN / Komunitas CyberSec',
            ],
            [
                'nama'          => 'Kompetisi Data Science Kaggle',
                'jenis'         => 'lomba',
                'deskripsi'     => 'Kompetisi analisis data dan machine learning berbasis dataset nyata. Diakui secara internasional.',
                'penyelenggara' => 'Kaggle (online)',
            ],
            [
                'nama'          => 'GEMASTIK (Pagelaran Mahasiswa TIK)',
                'jenis'         => 'lomba',
                'deskripsi'     => 'Kompetisi TIK bergengsi tingkat nasional yang diselenggarakan Kemendikbud. Mencakup programming, data mining, UI/UX, dan animasi.',
                'penyelenggara' => 'Kemendikbud',
            ],
            // ── Sertifikasi ────────────────────────────────────────────────────
            [
                'nama'          => 'AWS Certified Cloud Practitioner',
                'jenis'         => 'sertifikasi',
                'deskripsi'     => 'Sertifikasi cloud computing level dasar dari Amazon Web Services. Diakui secara global dan sangat dicari industri.',
                'penyelenggara' => 'Amazon Web Services',
            ],
            [
                'nama'          => 'Google Associate Android Developer',
                'jenis'         => 'sertifikasi',
                'deskripsi'     => 'Sertifikasi resmi Google untuk pengembangan aplikasi Android menggunakan Kotlin/Java.',
                'penyelenggara' => 'Google',
            ],
            [
                'nama'          => 'TensorFlow Developer Certificate',
                'jenis'         => 'sertifikasi',
                'deskripsi'     => 'Sertifikasi dari Google untuk praktisi machine learning yang menggunakan TensorFlow. Diakui di industri AI global.',
                'penyelenggara' => 'Google / TensorFlow',
            ],
            [
                'nama'          => 'CompTIA Security+',
                'jenis'         => 'sertifikasi',
                'deskripsi'     => 'Sertifikasi keamanan siber entry-level yang diakui secara internasional. Wajib untuk karir di bidang cybersecurity.',
                'penyelenggara' => 'CompTIA',
            ],
        ];

        foreach ($data as $item) {
            Kegiatan::create($item);
        }
    }
}