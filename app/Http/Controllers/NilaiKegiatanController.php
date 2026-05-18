<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Kriteria;
use App\Models\NilaiKegiatan;
use Illuminate\Http\Request;

class NilaiKegiatanController extends Controller
{
    /**
     * Tampilkan form isi nilai kegiatan (matriks keputusan).
     * Ini halaman admin untuk isi nilai tiap kegiatan per kriteria.
     * Route: GET /nilai-kegiatan/{kegiatan}
     */
    public function edit(Kegiatan $kegiatan)
    {
        $kriteria        = Kriteria::with('bobot')->orderBy('kode')->get();
        $nilaiExisting   = NilaiKegiatan::where('kegiatan_id', $kegiatan->id)
                                         ->pluck('nilai', 'kriteria_id');

        return view('nilai-kegiatan.edit', compact('kegiatan', 'kriteria', 'nilaiExisting'));
    }

    /**
     * Simpan/update semua nilai untuk satu kegiatan sekaligus.
     * Route: POST /nilai-kegiatan/{kegiatan}
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $kriteria = Kriteria::all();

        $rules = [];
        foreach ($kriteria as $k) {
            $rules["nilai.{$k->id}"] = 'required|numeric|min:1|max:5';
        }

        $request->validate($rules);

        // Upsert semua nilai sekaligus
        foreach ($request->input('nilai') as $kriteriaId => $nilai) {
            NilaiKegiatan::updateOrCreate(
                [
                    'kegiatan_id' => $kegiatan->id,
                    'kriteria_id' => $kriteriaId,
                ],
                ['nilai' => $nilai]
            );
        }

        return redirect()->route('kegiatan.index')
                         ->with('success', "Nilai untuk kegiatan '{$kegiatan->nama}' berhasil disimpan.");
    }
}