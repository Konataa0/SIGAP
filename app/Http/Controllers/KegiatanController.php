<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Services\SawService;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    protected SawService $sawService;

    public function __construct(SawService $sawService)
    {
        $this->sawService = $sawService;
    }

    // ─── CRUD Kegiatan (dipakai Admin) ──────────────────────────────────────

    /**
     * Tampilkan semua kegiatan.
     * Route: GET /kegiatan
     */
    public function index()
    {
        $kegiatan = Kegiatan::orderBy('jenis')->orderBy('nama')->get();
        return view('kegiatan.index', compact('kegiatan'));
    }

    /**
     * Tampilkan form tambah kegiatan.
     * Route: GET /kegiatan/create
     */
    public function create()
    {
        return view('kegiatan.create');
    }

    /**
     * Simpan kegiatan baru.
     * Route: POST /kegiatan
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'         => 'required|string|max:255',
            'jenis'        => 'required|in:ukm,lomba,sertifikasi',
            'deskripsi'    => 'nullable|string',
            'penyelenggara'=> 'nullable|string|max:255',
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')
                                           ->store('kegiatan', 'public');
        }

        Kegiatan::create($validated);

        return redirect()->route('kegiatan.index')
                         ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail satu kegiatan.
     * Route: GET /kegiatan/{id}
     */
    public function show(Kegiatan $kegiatan)
    {
        $kegiatan->load('nilaiKegiatan.kriteria');
        return view('kegiatan.show', compact('kegiatan'));
    }

    /**
     * Tampilkan form edit kegiatan.
     * Route: GET /kegiatan/{id}/edit
     */
    public function edit(Kegiatan $kegiatan)
    {
        return view('kegiatan.edit', compact('kegiatan'));
    }

    /**
     * Update data kegiatan.
     * Route: PUT /kegiatan/{id}
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validated = $request->validate([
            'nama'         => 'required|string|max:255',
            'jenis'        => 'required|in:ukm,lomba,sertifikasi',
            'deskripsi'    => 'nullable|string',
            'penyelenggara'=> 'nullable|string|max:255',
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')
                                           ->store('kegiatan', 'public');
        }

        $kegiatan->update($validated);

        return redirect()->route('kegiatan.index')
                         ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    /**
     * Hapus kegiatan.
     * Route: DELETE /kegiatan/{id}
     */
    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();
        return redirect()->route('kegiatan.index')
                         ->with('success', 'Kegiatan berhasil dihapus.');
    }

    // ─── Proses SAW (dipakai Mahasiswa) ─────────────────────────────────────

    /**
     * Proses form preferensi dari Anggota 2 dan hitung SAW.
     * Route: POST /rekomendasi
     */
    public function prosesRekomendasi(Request $request)
    {
        $request->validate([
            'preferensi'   => 'required|array',
            'preferensi.*' => 'required|integer|min:1|max:5',
        ]);

        $userId     = auth()->id();
        $preferensi = $request->input('preferensi');
        // $preferensi contoh: ['C1' => 4, 'C2' => 3, 'C3' => 2, 'C4' => 5]

        $hasil = $this->sawService->hitung($userId, $preferensi);

        // Redirect ke halaman hasil (Anggota 2 yang buat view-nya)
        return redirect()->route('rekomendasi.hasil')
                         ->with('success', 'Rekomendasi berhasil dihitung!');
    }

    /**
     * Tampilkan halaman hasil rekomendasi.
     * Route: GET /rekomendasi/hasil
     */
    public function hasilRekomendasi()
    {
        $userId = auth()->id();
        $hasil  = $this->sawService->ambilHasil($userId);

        // Anggota 2 yang buat view 'rekomendasi.hasil'
        return view('rekomendasi.hasil', compact('hasil'));
    }
}