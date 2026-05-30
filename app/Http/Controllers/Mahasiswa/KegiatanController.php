<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class KegiatanController extends Controller
{
    public function show(Kegiatan $kegiatan)
    {
        $this->authorize('view', $kegiatan);

        $user = Auth::user();
        abort_unless($user instanceof User, 403);
        /** @var User $user */
        $bookmarkActive = $user->bookmarkKegiatan()->whereKey($kegiatan->id)->exists();
        $keikutsertaan = $user->keikutsertaan()->where('kegiatan_id', $kegiatan->id)->first();

        return view('mahasiswa.kegiatan.show', compact('kegiatan', 'bookmarkActive', 'keikutsertaan'));
    }
}
