<?php

namespace App\Http\Services;

use App\Models\Kegiatan;
use App\Models\Kriteria;
use App\Models\HasilRekomendasi;
use Illuminate\Support\Facades\DB;

class SawService
{
    /**
     * Proses utama SAW yang benar.
     *
     * Alur SAW yang benar:
     *   1. Matriks keputusan X[i][j]  = nilai murni kegiatan i pada kriteria j (dari DB)
     *   2. Normalisasi R[i][j]         = benefit: X/max | cost: min/X
     *   3. Bobot W[j]                  = bobot tetap × faktor preferensi mahasiswa
     *                                    (preferensi user menggeser bobot, BUKAN mengubah nilai kegiatan)
     *   4. Skor akhir V[i]             = Σ W[j] × R[i][j]
     *
     * @param  int   $userId      ID user yang meminta rekomendasi
     * @param  array $preferensi  Nilai preferensi mahasiswa per kode kriteria
     *                            Format: ['C1' => 4, 'C2' => 3, 'C3' => 2, 'C4' => 5]
     * @return array              Array hasil ranking
     */
    public function hitung(int $userId, array $preferensi): array
    {
        $preferensiKriteria = $this->konversiPreferensi($preferensi);

        // ─── Langkah 1: Ambil data dari database ──────────────────────────────
        $semuaKegiatan = Kegiatan::with('nilaiKegiatan.kriteria')->get();
        $semuaKriteria = Kriteria::with('bobot')->get();

        if ($semuaKegiatan->isEmpty() || $semuaKriteria->isEmpty()) {
            return [];
        }

        // ─── Langkah 2: Bangun matriks keputusan MURNI ────────────────────────
        // X[kegiatan_id][kode_kriteria] = nilai asli kegiatan (1–5)
        // Nilai ini TIDAK disentuh preferensi mahasiswa sama sekali.

        $matriks = [];

        foreach ($semuaKegiatan as $kegiatan) {
            foreach ($kegiatan->nilaiKegiatan as $nilaiRow) {
                $kode = $nilaiRow->kriteria->kode;
                $matriks[$kegiatan->id][$kode] = (float) $nilaiRow->nilai;
            }
        }

        // ─── Langkah 3: Normalisasi matriks (inti SAW) ────────────────────────
        // Benefit → r_ij = x_ij / max(kolom j)   (semakin besar semakin baik)
        // Cost    → r_ij = min(kolom j) / x_ij   (semakin kecil semakin baik)

        $matriks_normal = [];

        foreach ($semuaKriteria as $kriteria) {
            $kode  = $kriteria->kode;
            $jenis = $kriteria->jenis; // 'benefit' atau 'cost'

            // Kumpulkan semua nilai pada kolom kriteria ini
            $nilaiKolom = [];
            foreach ($matriks as $kegiatanId => $baris) {
                $nilaiKolom[$kegiatanId] = $baris[$kode] ?? 0;
            }

            $maxNilai = max($nilaiKolom);
            $minNilai = min($nilaiKolom);

            foreach ($nilaiKolom as $kegiatanId => $nilai) {
                if ($jenis === 'benefit') {
                    // Hindari pembagian nol: kalau semua nilai 0, hasil 0
                    $matriks_normal[$kegiatanId][$kode] = $maxNilai > 0
                        ? $nilai / $maxNilai
                        : 0;
                } else {
                    // cost: kalau nilai 0 (tidak ada data), anggap skor 0
                    $matriks_normal[$kegiatanId][$kode] = $nilai > 0
                        ? $minNilai / $nilai
                        : 0;
                }
            }
        }

        // ─── Langkah 4: Hitung bobot dinamis berbasis preferensi mahasiswa ─────
        //
        // PERBAIKAN UTAMA: preferensi mahasiswa menggeser BOBOT, bukan nilai.
        //
        // Rumus: W_dinamis[j] = W_tetap[j] × preferensi[j]
        // Kemudian dinormalisasi agar Σ W_dinamis = 1.0
        // Efeknya: kriteria yang diberi preferensi tinggi mendapat bobot lebih besar.

        $bobotDinamis = [];
        $totalBobot   = 0;

        foreach ($semuaKriteria as $kriteria) {
            $kode        = $kriteria->kode;
            $bobotTetap  = $kriteria->bobot->nilai ?? 0;
            $prefMhs     = $preferensiKriteria[$kode] ?? 3; // default 3 kalau tidak ada input

            // Gabungkan bobot tetap dengan preferensi mahasiswa
            $bobotDinamis[$kode] = $bobotTetap * $prefMhs;
            $totalBobot         += $bobotDinamis[$kode];
        }

        // Normalisasi bobot dinamis supaya totalnya tetap = 1.0
        if ($totalBobot > 0) {
            foreach ($bobotDinamis as $kode => $nilai) {
                $bobotDinamis[$kode] = $nilai / $totalBobot;
            }
        }

        // ─── Langkah 5: Hitung skor akhir V_i = Σ W_j × R_ij ─────────────────

        $skorAkhir = [];

        foreach ($semuaKegiatan as $kegiatan) {
            $kegiatanId = $kegiatan->id;
            $total      = 0;

            foreach ($semuaKriteria as $kriteria) {
                $kode      = $kriteria->kode;
                $bobot     = $bobotDinamis[$kode] ?? 0;
                $nilaiNorm = $matriks_normal[$kegiatanId][$kode] ?? 0;
                $total    += $bobot * $nilaiNorm;
            }

            $skorAkhir[$kegiatanId] = $total;
        }

        // ─── Langkah 6: Ranking — urutkan dari skor tertinggi ─────────────────
        arsort($skorAkhir);

        $hasil = [];
        $rank  = 1;

        foreach ($skorAkhir as $kegiatanId => $skor) {
            $kegiatan = $semuaKegiatan->firstWhere('id', $kegiatanId);
            $hasil[]  = [
                'ranking'     => $rank,
                'kegiatan_id' => $kegiatanId,
                'kegiatan'    => $kegiatan,
                'skor'        => round($skor, 6),
            ];
            $rank++;
        }

        // ─── Langkah 7: Simpan hasil ke database ──────────────────────────────
        $this->simpanHasil($userId, $hasil, $preferensi, $preferensiKriteria);

        return $hasil;
    }

    /**
     * Simpan hasil ke tabel hasil_rekomendasi.
     * Setiap run disimpan sebagai sesi baru agar histori tetap utuh.
     */
    private function simpanHasil(int $userId, array $hasil, array $preferensi, array $preferensiKriteria): void
    {
        DB::transaction(function () use ($userId, $hasil, $preferensi, $preferensiKriteria) {
            $hasilDetail = collect($hasil)->map(function (array $row) {
                return [
                    'ranking'     => $row['ranking'],
                    'kegiatan_id' => $row['kegiatan_id'],
                    'nama'        => $row['kegiatan']->nama,
                    'jenis'       => $row['kegiatan']->jenis,
                    'skor'        => $row['skor'],
                ];
            })->values()->toArray();

            HasilRekomendasi::create([
                'user_id'      => $userId,
                'preferensi'   => $preferensi,
                'hasil_detail' => $hasilDetail,
                'top_tiga'     => array_slice($hasilDetail, 0, 3),
            ]);
        });
    }

    /**
     * Ubah input form mahasiswa menjadi bobot preferensi C1-C4.
     */
    private function konversiPreferensi(array $preferensi): array
    {
        $minatTeknis = $preferensi['minat_teknis'] ?? [];
        $targetKarir = $preferensi['target_karir'] ?? '';
        $waktuLuang  = $preferensi['waktu_luang'] ?? '';
        $tujuan      = $preferensi['tujuan'] ?? '';

        $skorMinat = min(5, max(1, count($minatTeknis) + 2));

        $skorKarir = match ($targetKarir) {
            'software engineer' => 5,
            'data analyst' => 4,
            'UI/UX designer' => 4,
            'cybersecurity analyst' => 5,
            'AI engineer' => 5,
            'system analyst' => 4,
            default => 3,
        };

        $skorWaktu = match ($waktuLuang) {
            '<5 jam/minggu' => 5,
            '5-10 jam/minggu' => 3,
            '>10 jam/minggu' => 1,
            default => 3,
        };

        $skorTujuan = match ($tujuan) {
            'cari pengalaman' => 4,
            'persiapan kerja' => 5,
            'tingkatkan skill' => 5,
            'ikut kompetisi' => 4,
            default => 3,
        };

        return [
            'C1' => $skorMinat,
            'C2' => $skorKarir,
            'C3' => $skorWaktu,
            'C4' => $skorTujuan,
        ];
    }

    /**
     * Ambil hasil SAW terakhir milik user dari database.
     */
    public function ambilHasil(int $userId): array
    {
        $sesi = HasilRekomendasi::where('user_id', $userId)
            ->latest()
            ->first();

        if (!$sesi) {
            return [];
        }

        return collect($sesi->hasil_detail ?? [])->map(function (array $row) {
            return [
                'ranking'  => $row['ranking'] ?? null,
                'skor'     => $row['skor'] ?? 0,
                'kegiatan' => Kegiatan::find($row['kegiatan_id'] ?? null),
            ];
        })->filter(fn ($row) => $row['kegiatan'])->values()->toArray();
    }
}