<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class KeikutsertaanController extends Controller
{
    public function upsert(Request $request, Kegiatan $kegiatan)
    {
        Gate::authorize('akses-mahasiswa');

        $validated = $request->validate([
            'status'  => ['required', 'in:berminat,mendaftar,diterima,selesai'],
            'catatan' => ['nullable', 'string', 'max:1000'],
        ]);

        $user = Auth::user();
        abort_unless($user instanceof User, 403);
        /** @var User $user */

        $user->keikutsertaan()->updateOrCreate(
            ['kegiatan_id' => $kegiatan->id],
            [
                'status'  => $validated['status'],
                'catatan' => $validated['catatan'] ?? null,
            ]
        );

        return back()->with('success', 'Status keikutsertaan berhasil diperbarui.');
    }
}
