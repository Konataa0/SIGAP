<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProfilController extends Controller
{
    public function show()
    {
        Gate::authorize('akses-mahasiswa');

        $user = Auth::user();
        abort_unless($user instanceof User, 403);
        /** @var User $user */
        $keikutsertaan = $user->keikutsertaan()->with('kegiatan')->get();
        $totalKegiatanDiikuti = $keikutsertaan->count();
        $totalBookmark = $user->bookmarkKegiatan()->count();
        $totalSesiRekomendasi = $user->hasilRekomendasi()->count();
        $riwayatSelesai = $keikutsertaan
            ->where('status', 'selesai')
            ->pluck('kegiatan')
            ->filter();

        return view('mahasiswa.profil.show', compact(
            'user',
            'totalKegiatanDiikuti',
            'totalBookmark',
            'totalSesiRekomendasi',
            'riwayatSelesai'
        ));
    }

    public function update(Request $request)
    {
        Gate::authorize('akses-mahasiswa');

        $validated = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'jurusan'   => ['nullable', 'string', 'max:255'],
            'angkatan'  => ['nullable', 'string', 'max:4'],
        ]);

        $user = Auth::user();
        abort_unless($user instanceof User, 403);
        /** @var User $user */

        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
