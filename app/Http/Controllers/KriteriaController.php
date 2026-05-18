<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Bobot;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Tampilkan semua kriteria beserta bobotnya.
     * Route: GET /kriteria
     */
    public function index()
    {
        $kriteria     = Kriteria::with('bobot')->orderBy('kode')->get();
        $totalBobot   = $kriteria->sum(fn($k) => $k->bobot->nilai ?? 0);
        return view('kriteria.index', compact('kriteria', 'totalBobot'));
    }

    /**
     * Tampilkan form tambah kriteria.
     * Route: GET /kriteria/create
     */
    public function create()
    {
        return view('kriteria.create');
    }

    /**
     * Simpan kriteria baru + bobotnya.
     * Route: POST /kriteria
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'kode'        => 'required|string|max:10|unique:kriteria,kode',
            'jenis'       => 'required|in:benefit,cost',
            'keterangan'  => 'nullable|string',
            'bobot'       => 'required|numeric|min:0|max:1',
        ]);

        $kriteria = Kriteria::create([
            'nama'       => $validated['nama'],
            'kode'       => strtoupper($validated['kode']),
            'jenis'      => $validated['jenis'],
            'keterangan' => $validated['keterangan'] ?? null,
        ]);

        Bobot::create([
            'kriteria_id' => $kriteria->id,
            'nilai'       => $validated['bobot'],
        ]);

        return redirect()->route('kriteria.index')
                         ->with('success', 'Kriteria berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit kriteria.
     * Route: GET /kriteria/{id}/edit
     */
    public function edit(Kriteria $kriteria)
    {
        $kriteria->load('bobot');
        return view('kriteria.edit', compact('kriteria'));
    }

    /**
     * Update kriteria + bobotnya.
     * Route: PUT /kriteria/{id}
     */
    public function update(Request $request, Kriteria $kriteria)
    {
        $validated = $request->validate([
            'nama'       => 'required|string|max:255',
            'kode'       => 'required|string|max:10|unique:kriteria,kode,' . $kriteria->id,
            'jenis'      => 'required|in:benefit,cost',
            'keterangan' => 'nullable|string',
            'bobot'      => 'required|numeric|min:0|max:1',
        ]);

        $kriteria->update([
            'nama'       => $validated['nama'],
            'kode'       => strtoupper($validated['kode']),
            'jenis'      => $validated['jenis'],
            'keterangan' => $validated['keterangan'] ?? null,
        ]);

        // Update atau buat bobot
        $kriteria->bobot()->updateOrCreate(
            ['kriteria_id' => $kriteria->id],
            ['nilai'       => $validated['bobot']]
        );

        return redirect()->route('kriteria.index')
                         ->with('success', 'Kriteria berhasil diperbarui.');
    }

    /**
     * Hapus kriteria (bobot ikut terhapus karena cascade).
     * Route: DELETE /kriteria/{id}
     */
    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();
        return redirect()->route('kriteria.index')
                         ->with('success', 'Kriteria berhasil dihapus.');
    }
}