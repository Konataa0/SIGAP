<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Kriteria;
use App\Http\Services\SawService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    protected SawService $sawService;

    public function __construct(SawService $sawService)
    {
        $this->sawService = $sawService;
    }

    // =========================================================================
    // CRUD KEGIATAN (Admin)
    // =========================================================================

    public function index()
    {
        $kegiatan = Kegiatan::withCount('nilaiKegiatan')
                            ->orderBy('jenis')
                            ->orderBy('nama')
                            ->get();
        return view('kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        // Ambil semua kriteria agar admin bisa langsung isi nilai
        // saat menambahkan kegiatan baru
        $kriterias = Kriteria::orderBy('kode')->get();
        return view('kegiatan.create', compact('kriterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|max:255',
            'jenis'         => 'required|in:ukm,lomba,sertifikasi',
            'deskripsi'     => 'nullable|string',
            'penyelenggara' => 'nullable|string|max:255',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            // Validasi nilai per kriteria (C1–C4), skala 1–5
            'nilai'         => 'nullable|array',
            'nilai.*'       => 'nullable|integer|min:1|max:5',
        ]);

        $data = $request->only(['nama', 'jenis', 'deskripsi', 'penyelenggara']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }

        $kegiatan = Kegiatan::create($data);

        // Simpan nilai per kriteria ke tabel nilai_kegiatan
        // Format input: nilai[kriteria_id] = angka
        if ($request->filled('nilai')) {
            foreach ($request->nilai as $kriteriaId => $nilaiAngka) {
                if ($nilaiAngka !== null && $nilaiAngka !== '') {
                    $kegiatan->nilaiKegiatan()->updateOrCreate(
                        ['kriteria_id' => $kriteriaId],
                        ['nilai'       => $nilaiAngka]
                    );
                }
            }
        }

        return redirect()->route('admin.kegiatan.index')
                         ->with('success', "Kegiatan \"{$kegiatan->nama}\" berhasil ditambahkan.");
    }

    public function edit(Kegiatan $kegiatan)
    {
        $kriterias = Kriteria::orderBy('kode')->get();
        // Ambil nilai yang sudah ada, mapping kriteria_id => nilai
        $nilaiExisting = $kegiatan->nilaiKegiatan
                                  ->pluck('nilai', 'kriteria_id')
                                  ->toArray();

        return view('kegiatan.edit', compact('kegiatan', 'kriterias', 'nilaiExisting'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'nama'          => 'required|string|max:255',
            'jenis'         => 'required|in:ukm,lomba,sertifikasi',
            'deskripsi'     => 'nullable|string',
            'penyelenggara' => 'nullable|string|max:255',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nilai'         => 'nullable|array',
            'nilai.*'       => 'nullable|integer|min:1|max:5',
        ]);

        $data = $request->only(['nama', 'jenis', 'deskripsi', 'penyelenggara']);

        if ($request->hasFile('gambar')) {
            if ($kegiatan->gambar) {
                Storage::disk('public')->delete($kegiatan->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }

        $kegiatan->update($data);

        // Update nilai per kriteria
        if ($request->filled('nilai')) {
            foreach ($request->nilai as $kriteriaId => $nilaiAngka) {
                if ($nilaiAngka !== null && $nilaiAngka !== '') {
                    $kegiatan->nilaiKegiatan()->updateOrCreate(
                        ['kriteria_id' => $kriteriaId],
                        ['nilai'       => $nilaiAngka]
                    );
                }
            }
        }

        return redirect()->route('admin.kegiatan.index')
                         ->with('success', "Kegiatan \"{$kegiatan->nama}\" berhasil diperbarui.");
    }

    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->gambar) {
            Storage::disk('public')->delete($kegiatan->gambar);
        }

        $nama = $kegiatan->nama;
        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')
                         ->with('success', "Kegiatan \"{$nama}\" berhasil dihapus.");
    }

    // =========================================================================
    // SPK / SAW (Mahasiswa)
    // =========================================================================

    /**
     * Tampilkan form preferensi dengan kriteria dari DB (bukan hardcoded).
     * Sebelumnya: data kriteria ditulis manual di closure route.
     * Sekarang: diambil dari tabel kriteria beserta bobotnya.
     */
    public function formRekomendasi()
    {
        $kriteria = Kriteria::with('bobot')->orderBy('kode')->get();
        return view('rekomendasi.form', compact('kriteria'));
    }

    /**
     * Proses input preferensi dan jalankan algoritma SAW.
     */
    public function prosesRekomendasi(Request $request)
    {
        $request->validate([
            'preferensi'   => 'required|array',
            'preferensi.*' => 'required|integer|min:1|max:5',
        ]);

        // preferensi format: ['C1' => 4, 'C2' => 3, 'C3' => 2, 'C4' => 5]
        $preferensi = $request->input('preferensi');
        $userId     = auth()->id();

        $this->sawService->hitung($userId, $preferensi);

        return redirect()->route('rekomendasi.hasil')
                         ->with('success', 'Rekomendasi berhasil dihitung!');
    }

    /**
     * Tampilkan hasil ranking SAW dari DB.
     */
    public function hasilRekomendasi()
    {
        $userId = auth()->id();
        $hasil  = $this->sawService->ambilHasil($userId);
        return view('rekomendasi.hasil', compact('hasil'));
    }
}