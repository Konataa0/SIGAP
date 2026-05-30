@extends('layouts.app')

@section('page_title', 'Profil Mahasiswa')

@section('content')
<div class="space-y-6">
    <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6 md:p-8">
        <p class="text-xs font-bold uppercase tracking-[0.25em] text-cyan-400">Profil Pengembangan Diri</p>
        <h1 class="mt-3 text-3xl font-extrabold tracking-tight text-white">{{ $user->name }}</h1>
        <p class="mt-3 text-sm text-slate-400">Data diri, statistik, dan riwayat pengembangan diri mahasiswa.</p>
    </div>

    <div class="grid gap-4 md:grid-cols-4">
        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Kegiatan Diikuti</p>
            <p class="mt-2 text-3xl font-black text-white">{{ $totalKegiatanDiikuti }}</p>
        </div>
        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Bookmark</p>
            <p class="mt-2 text-3xl font-black text-white">{{ $totalBookmark }}</p>
        </div>
        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Sesi Rekomendasi</p>
            <p class="mt-2 text-3xl font-black text-white">{{ $totalSesiRekomendasi }}</p>
        </div>
        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Selesai</p>
            <p class="mt-2 text-3xl font-black text-white">{{ $riwayatSelesai->count() }}</p>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6">
            <h2 class="text-lg font-bold text-white">Data Diri</h2>
            <div class="mt-4 space-y-3 text-sm">
                <div class="flex items-center justify-between rounded-xl border border-slate-800 bg-slate-950 px-4 py-3"><span class="text-slate-400">Nama</span><span class="font-semibold text-white">{{ $user->name }}</span></div>
                <div class="flex items-center justify-between rounded-xl border border-slate-800 bg-slate-950 px-4 py-3"><span class="text-slate-400">Email</span><span class="font-semibold text-white">{{ $user->email }}</span></div>
                <div class="flex items-center justify-between rounded-xl border border-slate-800 bg-slate-950 px-4 py-3"><span class="text-slate-400">NIM</span><span class="font-semibold text-white">{{ $user->nim ?? '-' }}</span></div>
                <div class="flex items-center justify-between rounded-xl border border-slate-800 bg-slate-950 px-4 py-3"><span class="text-slate-400">Jurusan</span><span class="font-semibold text-white">{{ $user->jurusan ?? '-' }}</span></div>
                <div class="flex items-center justify-between rounded-xl border border-slate-800 bg-slate-950 px-4 py-3"><span class="text-slate-400">Angkatan</span><span class="font-semibold text-white">{{ $user->angkatan ?? '-' }}</span></div>
            </div>
        </div>

        <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6">
            <h2 class="text-lg font-bold text-white">Edit Profil</h2>
            <form action="{{ route('mahasiswa.profil.update') }}" method="POST" class="mt-4 space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-slate-400">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white">
                </div>
                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-slate-400">NIM</label>
                    <input type="text" value="{{ $user->nim ?? '-' }}" disabled class="w-full rounded-xl border border-slate-800 bg-slate-950 px-4 py-3 text-sm text-slate-400">
                </div>
                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-slate-400">Jurusan</label>
                    <input type="text" name="jurusan" value="{{ old('jurusan', $user->jurusan) }}" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white">
                </div>
                <div>
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wider text-slate-400">Angkatan</label>
                    <input type="text" name="angkatan" value="{{ old('angkatan', $user->angkatan) }}" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white">
                </div>
                <button type="submit" class="rounded-xl bg-cyan-500 px-5 py-3 text-sm font-bold text-slate-950">Simpan Profil</button>
            </form>
        </div>
    </div>

    <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6">
        <h2 class="text-lg font-bold text-white">Riwayat Pengembangan Diri</h2>
        <div class="mt-4 grid gap-3 md:grid-cols-2">
            @forelse($riwayatSelesai as $kegiatan)
                <div class="rounded-xl border border-emerald-500/20 bg-emerald-500/5 p-4">
                    <p class="font-semibold text-white">{{ $kegiatan->nama }}</p>
                    <p class="text-xs text-emerald-300">Status selesai</p>
                </div>
            @empty
                <p class="text-sm text-slate-400">Belum ada riwayat kegiatan selesai.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
