<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        Gate::authorize('akses-mahasiswa');

        $user = Auth::user();
        abort_unless($user instanceof User, 403);
        /** @var User $user */
        $keikutsertaan = $user->keikutsertaan()->with('kegiatan')->latest()->get();
        $bookmarkCount = $user->bookmarkKegiatan()->count();
        $sessionCount = $user->hasilRekomendasi()->count();
        $statusSummary = $keikutsertaan->countBy('status');
        $riwayatSelesai = $keikutsertaan
            ->where('status', 'selesai')
            ->pluck('kegiatan')
            ->filter();
        $bookmarkKegiatan = $user->bookmarkKegiatan()->orderBy('nama')->get();

        return view('mahasiswa.dashboard', compact(
            'user',
            'keikutsertaan',
            'bookmarkCount',
            'sessionCount',
            'statusSummary',
            'riwayatSelesai',
            'bookmarkKegiatan'
        ));
    }
}
