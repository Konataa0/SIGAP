<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\HasilRekomendasi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RekomendasiHistoryController extends Controller
{
    public function index()
    {
        Gate::authorize('akses-mahasiswa');

        $user = Auth::user();
        abort_unless($user instanceof User, 403);
        /** @var User $user */

        $histori = $user->hasilRekomendasi()->latest()->get();

        return view('mahasiswa.rekomendasi.history.index', compact('histori'));
    }

    public function show(HasilRekomendasi $hasilRekomendasi)
    {
        Gate::authorize('akses-mahasiswa');

        $userId = Auth::id();
        abort_unless($hasilRekomendasi->user_id === $userId, 403);

        return view('mahasiswa.rekomendasi.history.show', compact('hasilRekomendasi'));
    }
}
