<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Kriteria;
use App\Http\Services\SawService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
        Gate::authorize('akses-admin');

        $kegiatan = Kegiatan::withCount('nilaiKegiatan')
                            ->orderBy('jenis')
                            ->orderBy('nama')
                            ->get();
        return view('kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        Gate::authorize('akses-admin');

        // Ambil semua kriteria agar admin bisa langsung isi nilai
        // saat menambahkan kegiatan baru
        $kriterias = Kriteria::orderBy('kode')->get();
        return view('kegiatan.create', compact('kriterias'));
    }

    public function store(Request $request)
    {
        Gate::authorize('akses-admin');

        $request->validate([
            'nama'          => 'required|string|max:255',
            'jenis'         => 'required|in:ukm,lomba,sertifikasi',
            'deskripsi'     => 'nullable|string',
            'penyelenggara' => 'nullable|string|max:255',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'syarat_ketentuan'   => 'nullable|string',
            'deadline_pendaftaran' => 'nullable|date',
            'link_pendaftaran'   => 'nullable|url',
            'kontak_pic'         => 'nullable|string|max:255',
            // Validasi nilai per kriteria (C1–C4), skala 1–5
            'nilai'         => 'nullable|array',
            'nilai.*'       => 'nullable|integer|min:1|max:5',
        ]);

        $data = $request->only([
            'nama', 'jenis', 'deskripsi', 'penyelenggara',
            'syarat_ketentuan', 'deadline_pendaftaran', 'link_pendaftaran', 'kontak_pic',
        ]);

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
        Gate::authorize('akses-admin');

        $kriterias = Kriteria::orderBy('kode')->get();
        // Ambil nilai yang sudah ada, mapping kriteria_id => nilai
        $nilaiExisting = $kegiatan->nilaiKegiatan
                                  ->pluck('nilai', 'kriteria_id')
                                  ->toArray();

        return view('kegiatan.edit', compact('kegiatan', 'kriterias', 'nilaiExisting'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        Gate::authorize('akses-admin');

        $request->validate([
            'nama'          => 'required|string|max:255',
            'jenis'         => 'required|in:ukm,lomba,sertifikasi',
            'deskripsi'     => 'nullable|string',
            'penyelenggara' => 'nullable|string|max:255',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'syarat_ketentuan'   => 'nullable|string',
            'deadline_pendaftaran' => 'nullable|date',
            'link_pendaftaran'   => 'nullable|url',
            'kontak_pic'         => 'nullable|string|max:255',
            'nilai'         => 'nullable|array',
            'nilai.*'       => 'nullable|integer|min:1|max:5',
        ]);

        $data = $request->only([
            'nama', 'jenis', 'deskripsi', 'penyelenggara',
            'syarat_ketentuan', 'deadline_pendaftaran', 'link_pendaftaran', 'kontak_pic',
        ]);

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
        Gate::authorize('akses-admin');

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
        Gate::authorize('akses-mahasiswa');

        $minatTeknis = ['frontend', 'backend', 'mobile', 'AI/ML', 'cybersecurity', 'data science', 'cloud', 'IoT'];
        $targetKarir = ['software engineer', 'data analyst', 'UI/UX designer', 'cybersecurity analyst', 'AI engineer', 'system analyst'];
        $waktuLuang = ['<5 jam/minggu', '5-10 jam/minggu', '>10 jam/minggu'];
        $tujuan = ['cari pengalaman', 'persiapan kerja', 'tingkatkan skill', 'ikut kompetisi'];

        return view('rekomendasi.form', compact('minatTeknis', 'targetKarir', 'waktuLuang', 'tujuan'));
    }

    /**
     * Proses input preferensi dan jalankan algoritma SAW.
     */
    public function prosesRekomendasi(Request $request)
    {
        Gate::authorize('akses-mahasiswa');

        $request->validate([
            'minat_teknis'   => 'required|array|min:1',
            'minat_teknis.*' => 'required|string',
            'target_karir'   => 'required|string',
            'waktu_luang'    => 'required|string',
            'tujuan'         => 'required|string',
        ]);

        $preferensi = $request->only(['minat_teknis', 'target_karir', 'waktu_luang', 'tujuan']);
        $userId     = Auth::id();

        $this->sawService->hitung($userId, $preferensi);

        return redirect()->route('rekomendasi.hasil')
                         ->with('success', 'Rekomendasi berhasil dihitung!');
    }

    /**
     * Tampilkan hasil ranking SAW dari DB.
     */
    public function hasilRekomendasi()
    {
        Gate::authorize('akses-mahasiswa');

        $userId = Auth::id();
        $hasil  = $this->sawService->ambilHasil($userId);
        return view('rekomendasi.hasil', compact('hasil'));
    }
}