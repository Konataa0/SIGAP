@extends('layouts.app')

@section('page_title', 'Dashboard Mahasiswa')

@section('content')
<div class="space-y-8">
    <div class="rounded-3xl border border-slate-800 bg-gradient-to-br from-slate-900 to-slate-950 p-6 md:p-8">
        <p class="text-xs font-bold uppercase tracking-[0.25em] text-cyan-400">Dashboard Mahasiswa</p>
        <h1 class="mt-3 text-3xl font-extrabold tracking-tight text-white">Selamat datang, {{ $user->name }}</h1>
        <p class="mt-3 max-w-3xl text-sm leading-relaxed text-slate-400">Ringkasan ini memperlihatkan bookmark, status keikutsertaan, sesi rekomendasi, dan riwayat pengembangan diri kamu di SIGAP.</p>
    </div>

    <div class="grid gap-4 md:grid-cols-4">
        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Keikutsertaan</p>
            <p class="mt-2 text-3xl font-black text-white">{{ $keikutsertaan->count() }}</p>
        </div>
        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Bookmark</p>
            <p class="mt-2 text-3xl font-black text-white">{{ $bookmarkCount }}</p>
        </div>
        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Sesi Rekomendasi</p>
            <p class="mt-2 text-3xl font-black text-white">{{ $sessionCount }}</p>
        </div>
        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Selesai</p>
            <p class="mt-2 text-3xl font-black text-white">{{ $statusSummary['selesai'] ?? 0 }}</p>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6">
            <div class="flex items-center justify-between gap-3">
                <h2 class="text-lg font-bold text-white">Ringkasan Status</h2>
                <a href="{{ route('kegiatan.public') }}" class="text-sm font-semibold text-cyan-400">Lihat kegiatan</a>
            </div>
            <div class="mt-4 space-y-3 text-sm">
                @foreach(['berminat', 'mendaftar', 'diterima', 'selesai'] as $status)
                    <div class="flex items-center justify-between rounded-xl border border-slate-800 bg-slate-950 px-4 py-3">
                        <span class="capitalize text-slate-300">{{ $status }}</span>
                        <span class="font-bold text-white">{{ $statusSummary[$status] ?? 0 }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6">
            <div class="flex items-center justify-between gap-3">
                <h2 class="text-lg font-bold text-white">Kegiatan Tersimpan</h2>
                <a href="{{ route('mahasiswa.bookmark.index') }}" class="text-sm font-semibold text-cyan-400">Buka daftar</a>
            </div>
            <div class="mt-4 space-y-3">
                @forelse($bookmarkKegiatan as $kegiatan)
                    <div class="rounded-xl border border-slate-800 bg-slate-950 px-4 py-3">
                        <p class="font-semibold text-white">{{ $kegiatan->nama }}</p>
                        <p class="text-xs text-slate-400">{{ ucfirst($kegiatan->jenis) }}</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-400">Belum ada kegiatan yang disimpan.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6">
            <h2 class="text-lg font-bold text-white">Riwayat Pengembangan Diri</h2>
            <div class="mt-4 space-y-3">
                @forelse($riwayatSelesai as $kegiatan)
                    <div class="rounded-xl border border-emerald-500/20 bg-emerald-500/5 px-4 py-3">
                        <p class="font-semibold text-white">{{ $kegiatan->nama }}</p>
                        <p class="text-xs text-emerald-300">Status selesai</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-400">Belum ada kegiatan selesai.</p>
                @endforelse
            </div>
        </div>

        <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6">
            <h2 class="text-lg font-bold text-white">Aksi Cepat</h2>
            <div class="mt-4 grid gap-3 sm:grid-cols-2">
                <a href="{{ route('rekomendasi.form') }}" class="rounded-xl bg-cyan-500 px-4 py-3 text-sm font-bold text-slate-950">Buat Rekomendasi</a>
                <a href="{{ route('mahasiswa.profil.show') }}" class="rounded-xl border border-slate-700 px-4 py-3 text-sm font-semibold text-slate-200">Lihat Profil</a>
                <a href="{{ route('mahasiswa.history.index') }}" class="rounded-xl border border-slate-700 px-4 py-3 text-sm font-semibold text-slate-200">Histori SAW</a>
                <a href="{{ route('mahasiswa.bookmark.index') }}" class="rounded-xl border border-slate-700 px-4 py-3 text-sm font-semibold text-slate-200">Bookmark</a>
            </div>
        </div>
    </div>
</div>
@endsection
