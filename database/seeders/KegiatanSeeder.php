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
                'syarat_ketentuan'   => 'Terbuka untuk seluruh mahasiswa aktif. Wajib mengikuti pertemuan rutin dan proyek tim.',
                'deadline_pendaftaran' => '2026-06-15',
                'link_pendaftaran'   => 'https://example.com/daftar-robotika',
                'kontak_pic'         => '08xx-robotika',
            ],
            [
                'nama'          => 'UKM Cyber Security',
                'jenis'         => 'ukm',
                'deskripsi'     => 'Komunitas mahasiswa yang mempelajari keamanan siber, ethical hacking, dan forensik digital. Aktif mengikuti kompetisi CTF.',
                'penyelenggara' => 'BEM Fakultas',
                'syarat_ketentuan'   => 'Memahami dasar jaringan dan bersedia latihan malam bila ada simulasi CTF.',
                'deadline_pendaftaran' => '2026-06-20',
                'link_pendaftaran'   => 'https://example.com/daftar-cyber',
                'kontak_pic'         => '08xx-cyber',
            ],
            [
                'nama'          => 'UKM Pengembangan Aplikasi',
                'jenis'         => 'ukm',
                'deskripsi'     => 'UKM yang fokus pada pengembangan aplikasi web dan mobile. Mengerjakan proyek nyata untuk masyarakat dan startup.',
                'penyelenggara' => 'BEM Fakultas',
                'syarat_ketentuan'   => 'Memiliki minat pada pengembangan aplikasi dan siap belajar kolaborasi tim.',
                'deadline_pendaftaran' => '2026-06-18',
                'link_pendaftaran'   => 'https://example.com/daftar-aplikasi',
                'kontak_pic'         => '08xx-aplikasi',
            ],
            [
                'nama'          => 'UKM Kecerdasan Buatan',
                'jenis'         => 'ukm',
                'deskripsi'     => 'UKM yang membahas machine learning, deep learning, dan data science. Aktif dalam riset dan kompetisi AI.',
                'penyelenggara' => 'Himpunan Mahasiswa',
                'syarat_ketentuan'   => 'Wajib memiliki dasar Python atau statistik dasar.',
                'deadline_pendaftaran' => '2026-06-22',
                'link_pendaftaran'   => 'https://example.com/daftar-ai',
                'kontak_pic'         => '08xx-ai',
            ],
            // ── Lomba ─────────────────────────────────────────────────────────
            [
                'nama'          => 'Hackathon Nasional Kemahasiswaan',
                'jenis'         => 'lomba',
                'deskripsi'     => 'Kompetisi sprint 24-48 jam membangun produk digital. Berhadiah dan membuka peluang magang di perusahaan teknologi nasional.',
                'penyelenggara' => 'Kemendikbud',
                'syarat_ketentuan'   => 'Siap mengikuti lomba intensif dan bekerja dalam tim multidisiplin.',
                'deadline_pendaftaran' => '2026-07-01',
                'link_pendaftaran'   => 'https://example.com/daftar-hackathon',
                'kontak_pic'         => '08xx-hackathon',
            ],
            [
                'nama'          => 'Lomba CTF (Capture The Flag)',
                'jenis'         => 'lomba',
                'deskripsi'     => 'Kompetisi keamanan siber berbasis tantangan. Peserta memecahkan soal kriptografi, reverse engineering, dan web exploitation.',
                'penyelenggara' => 'BSSN / Komunitas CyberSec',
                'syarat_ketentuan'   => 'Memiliki pemahaman dasar keamanan web dan logika problem solving.',
                'deadline_pendaftaran' => '2026-07-03',
                'link_pendaftaran'   => 'https://example.com/daftar-ctf',
                'kontak_pic'         => '08xx-ctf',
            ],
            [
                'nama'          => 'Kompetisi Data Science Kaggle',
                'jenis'         => 'lomba',
                'deskripsi'     => 'Kompetisi analisis data dan machine learning berbasis dataset nyata. Diakui secara internasional.',
                'penyelenggara' => 'Kaggle (online)',
                'syarat_ketentuan'   => 'Memahami Python, data cleaning, dan visualisasi dasar.',
                'deadline_pendaftaran' => '2026-07-10',
                'link_pendaftaran'   => 'https://example.com/daftar-datascience',
                'kontak_pic'         => '08xx-datascience',
            ],
            [
                'nama'          => 'GEMASTIK (Pagelaran Mahasiswa TIK)',
                'jenis'         => 'lomba',
                'deskripsi'     => 'Kompetisi TIK bergengsi tingkat nasional yang diselenggarakan Kemendikbud. Mencakup programming, data mining, UI/UX, dan animasi.',
                'penyelenggara' => 'Kemendikbud',
                'syarat_ketentuan'   => 'Mahasiswa aktif dan bersedia mengikuti seleksi internal kampus.',
                'deadline_pendaftaran' => '2026-07-08',
                'link_pendaftaran'   => 'https://example.com/daftar-gemastik',
                'kontak_pic'         => '08xx-gemastik',
            ],
            // ── Sertifikasi ────────────────────────────────────────────────────
            [
                'nama'          => 'AWS Certified Cloud Practitioner',
                'jenis'         => 'sertifikasi',
                'deskripsi'     => 'Sertifikasi cloud computing level dasar dari Amazon Web Services. Diakui secara global dan sangat dicari industri.',
                'penyelenggara' => 'Amazon Web Services',
                'syarat_ketentuan'   => 'Direkomendasikan menguasai konsep dasar cloud computing.',
                'deadline_pendaftaran' => '2026-07-15',
                'link_pendaftaran'   => 'https://example.com/daftar-aws',
                'kontak_pic'         => '08xx-aws',
            ],
            [
                'nama'          => 'Google Associate Android Developer',
                'jenis'         => 'sertifikasi',
                'deskripsi'     => 'Sertifikasi resmi Google untuk pengembangan aplikasi Android menggunakan Kotlin/Java.',
                'penyelenggara' => 'Google',
                'syarat_ketentuan'   => 'Memiliki dasar Kotlin atau Java dan pernah membuat aplikasi Android sederhana.',
                'deadline_pendaftaran' => '2026-07-18',
                'link_pendaftaran'   => 'https://example.com/daftar-android',
                'kontak_pic'         => '08xx-android',
            ],
            [
                'nama'          => 'TensorFlow Developer Certificate',
                'jenis'         => 'sertifikasi',
                'deskripsi'     => 'Sertifikasi dari Google untuk praktisi machine learning yang menggunakan TensorFlow. Diakui di industri AI global.',
                'penyelenggara' => 'Google / TensorFlow',
                'syarat_ketentuan'   => 'Disarankan memahami Python dan alur kerja machine learning dasar.',
                'deadline_pendaftaran' => '2026-07-20',
                'link_pendaftaran'   => 'https://example.com/daftar-tensorflow',
                'kontak_pic'         => '08xx-tensorflow',
            ],
            [
                'nama'          => 'CompTIA Security+',
                'jenis'         => 'sertifikasi',
                'deskripsi'     => 'Sertifikasi keamanan siber entry-level yang diakui secara internasional. Wajib untuk karir di bidang cybersecurity.',
                'penyelenggara' => 'CompTIA',
                'syarat_ketentuan'   => 'Memiliki pemahaman dasar jaringan, sistem operasi, dan praktik keamanan informasi.',
                'deadline_pendaftaran' => '2026-07-25',
                'link_pendaftaran'   => 'https://example.com/daftar-comptia',
                'kontak_pic'         => '08xx-comptia',
            ],
        ];

        foreach ($data as $item) {
            Kegiatan::create($item);
        }
    }
}