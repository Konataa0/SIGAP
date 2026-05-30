@extends('layouts.app')

@section('page_title', 'Kegiatan Tersimpan')

@section('content')
<div class="space-y-6">
    <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6 md:p-8">
        <p class="text-xs font-bold uppercase tracking-[0.25em] text-cyan-400">Bookmark</p>
        <h1 class="mt-3 text-3xl font-extrabold tracking-tight text-white">Kegiatan Tersimpan</h1>
        <p class="mt-3 max-w-3xl text-sm leading-relaxed text-slate-400">Daftar kegiatan yang kamu simpan untuk dibuka lagi nanti.</p>
    </div>

    <div class="grid gap-4">
        @forelse($bookmarkKegiatan as $kegiatan)
            <div class="flex flex-col gap-4 rounded-2xl border border-slate-800 bg-slate-900 p-5 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-white">{{ $kegiatan->nama }}</h2>
                    <p class="text-sm text-slate-400">{{ ucfirst($kegiatan->jenis) }}</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('mahasiswa.kegiatan.show', $kegiatan) }}" class="rounded-xl bg-cyan-500 px-4 py-2.5 text-sm font-bold text-slate-950">Buka Detail</a>
                    <form action="{{ route('mahasiswa.bookmark.toggle', $kegiatan) }}" method="POST">
                        @csrf
                        <button type="submit" class="rounded-xl border border-slate-700 px-4 py-2.5 text-sm font-semibold text-slate-200">Hapus Simpanan</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="rounded-2xl border border-slate-800 bg-slate-900 p-8 text-slate-400">Belum ada kegiatan tersimpan.</div>
        @endforelse
    </div>
</div>
@endsection
