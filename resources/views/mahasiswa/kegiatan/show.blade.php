@extends('layouts.app')

@section('page_title', 'Detail Kegiatan')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="rounded-3xl border border-slate-800 bg-slate-900/80 p-6 md:p-8 shadow-xl">
        <div class="flex flex-col gap-3">
            <p class="text-xs font-bold uppercase tracking-[0.25em] text-cyan-400">Detail khusus mahasiswa</p>
            <h1 class="text-3xl font-extrabold tracking-tight text-white">{{ $kegiatan->nama }}</h1>
            <p class="text-sm text-slate-400">Kategori: {{ ucfirst($kegiatan->jenis) }}</p>
        </div>

        <div class="mt-6 grid gap-4 md:grid-cols-2">
            <div class="rounded-2xl border border-slate-800 bg-slate-950 p-5">
                <h2 class="text-sm font-bold text-white">Deskripsi</h2>
                <p class="mt-2 text-sm leading-relaxed text-slate-400">{{ $kegiatan->deskripsi ?? '-' }}</p>
            </div>
            <div class="rounded-2xl border border-slate-800 bg-slate-950 p-5">
                <h2 class="text-sm font-bold text-white">Syarat & Ketentuan</h2>
                <p class="mt-2 text-sm leading-relaxed text-slate-400 whitespace-pre-line">{{ $kegiatan->syarat_ketentuan ?? '-' }}</p>
            </div>
            <div class="rounded-2xl border border-slate-800 bg-slate-950 p-5">
                <h2 class="text-sm font-bold text-white">Deadline Pendaftaran</h2>
                <p class="mt-2 text-sm text-slate-400">{{ optional($kegiatan->deadline_pendaftaran)->format('d M Y') ?? '-' }}</p>
            </div>
            <div class="rounded-2xl border border-slate-800 bg-slate-950 p-5">
                <h2 class="text-sm font-bold text-white">Kontak PIC</h2>
                <p class="mt-2 text-sm text-slate-400">{{ $kegiatan->kontak_pic ?? '-' }}</p>
            </div>
        </div>

        <div class="mt-6 flex flex-wrap gap-3">
            @if($kegiatan->link_pendaftaran)
                <a href="{{ $kegiatan->link_pendaftaran }}" target="_blank" rel="noopener" class="inline-flex items-center rounded-xl bg-cyan-500 px-5 py-3 text-sm font-bold text-slate-950">Buka Link Pendaftaran</a>
            @endif
            <form action="{{ route('mahasiswa.bookmark.toggle', $kegiatan) }}" method="POST">
                @csrf
                <button type="submit" class="inline-flex items-center rounded-xl border border-slate-700 px-5 py-3 text-sm font-semibold text-slate-200">
                    {{ $bookmarkActive ? 'Hapus Simpanan' : 'Simpan Kegiatan' }}
                </button>
            </form>
            <a href="{{ route('mahasiswa.dashboard') }}" class="inline-flex items-center rounded-xl border border-slate-700 px-5 py-3 text-sm font-semibold text-slate-200">Kembali ke Dashboard</a>
        </div>

        <div class="mt-8 rounded-2xl border border-slate-800 bg-slate-950 p-5">
            <h2 class="text-sm font-bold text-white">Status Keikutsertaan</h2>
            <form action="{{ route('mahasiswa.keikutsertaan.upsert', $kegiatan) }}" method="POST" class="mt-4 grid gap-4 md:grid-cols-2">
                @csrf
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Status</label>
                    <select name="status" class="w-full rounded-xl border border-slate-700 bg-slate-900 px-4 py-3 text-sm text-white">
                        @foreach(['berminat', 'mendaftar', 'diterima', 'selesai'] as $status)
                            <option value="{{ $status }}" @selected(optional($keikutsertaan)->status === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Catatan</label>
                    <textarea name="catatan" rows="4" class="w-full rounded-xl border border-slate-700 bg-slate-900 px-4 py-3 text-sm text-white" placeholder="Catatan pribadi atau rencana tindak lanjut">{{ old('catatan', optional($keikutsertaan)->catatan) }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <button type="submit" class="inline-flex items-center rounded-xl bg-cyan-500 px-5 py-3 text-sm font-bold text-slate-950">Simpan Status</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
