<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;

class PublicKegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::select(['id', 'nama', 'jenis'])
            ->orderBy('jenis')
            ->orderBy('nama')
            ->get();

        return view('kegiatan.public', compact('kegiatan'));
    }
}
