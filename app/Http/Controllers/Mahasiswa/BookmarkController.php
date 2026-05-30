<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BookmarkController extends Controller
{
    public function index()
    {
        Gate::authorize('akses-mahasiswa');

        $user = Auth::user();
        abort_unless($user instanceof User, 403);
        /** @var User $user */

        $bookmarkKegiatan = $user->bookmarkKegiatan()->orderBy('nama')->get();

        return view('mahasiswa.bookmark.index', compact('bookmarkKegiatan'));
    }

    public function toggle(Kegiatan $kegiatan)
    {
        Gate::authorize('akses-mahasiswa');

        $user = Auth::user();
        abort_unless($user instanceof User, 403);
        /** @var User $user */
        $sudahDisimpan = $user->bookmarkKegiatan()->whereKey($kegiatan->id)->exists();

        if ($sudahDisimpan) {
            $user->bookmarkKegiatan()->detach($kegiatan->id);
            $pesan = 'Kegiatan dihapus dari simpanan.';
        } else {
            $user->bookmarkKegiatan()->attach($kegiatan->id);
            $pesan = 'Kegiatan disimpan.';
        }

        return back()->with('success', $pesan);
    }
}
