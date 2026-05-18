<?php

namespace App\Services;

use App\Models\Kegiatan;
use App\Models\Kriteria;
use App\Models\HasilSaw;
use Illuminate\Support\Facades\DB;

class SawService
{
    /**
     * Proses utama SAW.
     *
     * @param  int   $userId       ID user yang meminta rekomendasi
     * @param  array $preferensi   Nilai preferensi mahasiswa per kriteria
     *                             Format: ['C1' => 4, 'C2' => 3, 'C3' => 2, 'C4' => 5]
     *                             (kode kriteria => nilai 1–5)
     * @return array               Array kegiatan + skor + ranking, diurutkan ranking
     */
    public function hitung(int $userId, array $preferensi): array
    {
        // ─── Langkah 1: Ambil semua data yang dibutuhkan ───────────────────────

        $semuaKegiatan = Kegiatan::with('nilaiKegiatan.kriteria')->get();
        $semuaKriteria = Kriteria::with('bobot')->get();

        if ($semuaKegiatan->isEmpty() || $semuaKriteria->isEmpty()) {
            return [];
        }

        // ─── Langkah 2: Bangun matriks keputusan ───────────────────────────────
        //
        // $matriks[kegiatan_id][kriteria_kode] = nilai
        //
        // Kita gabungkan nilai dari database (nilai objektif tiap kegiatan)
        // dengan preferensi mahasiswa untuk memberi bobot subjektif.

        $matriks = [];

        foreach ($semuaKegiatan as $kegiatan) {
            $baris = [];
            foreach ($kegiatan->nilaiKegiatan as $nilaiRow) {
                $kode = $nilaiRow->kriteria->kode;
                // Nilai akhir = nilai kegiatan × (preferensi mahasiswa / skala maks)
                // Ini membuat kegiatan yang cocok dengan preferensi mahasiswa
                // mendapat nilai lebih tinggi.
                $nilaiPreferensi = $preferensi[$kode] ?? 3; // default 3 jika tidak ada input
                $faktorPreferensi = $nilaiPreferensi / 5;   // normalisasi ke 0–1
                $baris[$kode] = $nilaiRow->nilai * $faktorPreferensi;
            }
            $matriks[$kegiatan->id] = $baris;
        }

        // ─── Langkah 3: Normalisasi matriks (metode SAW) ───────────────────────
        //
        // Untuk setiap kolom kriteria:
        //   • benefit → r_ij = x_ij / max(x_j)
        //   • cost    → r_ij = min(x_j) / x_ij

        $matriks_normal = [];

        foreach ($semuaKriteria as $kriteria) {
            $kode   = $kriteria->kode;
            $jenis  = $kriteria->jenis;

            // Kumpulkan semua nilai pada kolom ini
            $nilaiKolom = [];
            foreach ($matriks as $kegiatanId => $baris) {
                $nilaiKolom[$kegiatanId] = $baris[$kode] ?? 0;
            }

            $maxNilai = max($nilaiKolom);
            $minNilai = min($nilaiKolom);

            // Hindari pembagian dengan nol
            if ($maxNilai == 0) {
                foreach ($matriks as $kegiatanId => $_) {
                    $matriks_normal[$kegiatanId][$kode] = 0;
                }
                continue;
            }

            foreach ($nilaiKolom as $kegiatanId => $nilai) {
                if ($jenis === 'benefit') {
                    $matriks_normal[$kegiatanId][$kode] = $nilai / $maxNilai;
                } else {
                    // cost: semakin kecil nilainya semakin bagus
                    $matriks_normal[$kegiatanId][$kode] = ($minNilai > 0)
                        ? $minNilai / $nilai
                        : 0;
                }
            }
        }

        // ─── Langkah 4: Hitung skor akhir (V_i = Σ w_j × r_ij) ────────────────

        $skorAkhir = [];

        foreach ($semuaKegiatan as $kegiatan) {
            $kegiatanId = $kegiatan->id;
            $total      = 0;

            foreach ($semuaKriteria as $kriteria) {
                $kode       = $kriteria->kode;
                $bobot      = $kriteria->bobot->nilai ?? 0;
                $nilaiNorm  = $matriks_normal[$kegiatanId][$kode] ?? 0;
                $total     += $bobot * $nilaiNorm;
            }

            $skorAkhir[$kegiatanId] = $total;
        }

        // ─── Langkah 5: Ranking ────────────────────────────────────────────────

        arsort($skorAkhir); // urutkan dari skor tertinggi

        $hasil  = [];
        $rank   = 1;

        foreach ($skorAkhir as $kegiatanId => $skor) {
            $kegiatan = $semuaKegiatan->firstWhere('id', $kegiatanId);
            $hasil[]  = [
                'ranking'      => $rank,
                'kegiatan_id'  => $kegiatanId,
                'kegiatan'     => $kegiatan,
                'skor'         => round($skor, 6),
            ];
            $rank++;
        }

        // ─── Langkah 6: Simpan ke tabel hasil_saw ──────────────────────────────

        $this->simpanHasil($userId, $hasil, $preferensi);

        return $hasil;
    }

    /**
     * Simpan hasil SAW ke database.
     * Kalau user sudah pernah hitung, hasil lama dihapus dulu (fresh).
     */
    private function simpanHasil(int $userId, array $hasil, array $preferensi): void
    {
        DB::transaction(function () use ($userId, $hasil, $preferensi) {
            // Hapus hasil lama milik user ini
            HasilSaw::where('user_id', $userId)->delete();

            // Insert semua hasil baru
            foreach ($hasil as $row) {
                HasilSaw::create([
                    'user_id'          => $userId,
                    'kegiatan_id'      => $row['kegiatan_id'],
                    'skor'             => $row['skor'],
                    'ranking'          => $row['ranking'],
                    'input_preferensi' => $preferensi,
                ]);
            }
        });
    }

    /**
     * Ambil hasil SAW terakhir milik user (sudah tersimpan di DB).
     * Dipakai oleh Anggota 2 untuk menampilkan halaman hasil.
     */
    public function ambilHasil(int $userId): array
    {
        $rows = HasilSaw::where('user_id', $userId)
                        ->with('kegiatan')
                        ->orderBy('ranking')
                        ->get();

        if ($rows->isEmpty()) {
            return [];
        }

        return $rows->map(function ($row) {
            return [
                'ranking'  => $row->ranking,
                'skor'     => $row->skor,
                'kegiatan' => $row->kegiatan,
            ];
        })->toArray();
    }
}