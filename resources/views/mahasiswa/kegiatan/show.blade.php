@extends('layouts.app')

@section('page_title', 'Detail Kegiatan — ' . $kegiatan->nama)

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-xs text-slate-500">
        <a href="{{ route('mahasiswa.dashboard') }}" class="hover:text-slate-300 transition-colors">Dashboard</a>
        <span>/</span>
        <a href="{{ route('rekomendasi.hasil') }}" class="hover:text-slate-300 transition-colors">Hasil Rekomendasi</a>
        <span>/</span>
        <span class="text-slate-300 truncate max-w-xs">{{ $kegiatan->nama }}</span>
    </nav>

    {{-- Header Kegiatan --}}
    <div class="rounded-3xl border border-slate-800 bg-slate-900/80 p-6 md:p-8 shadow-xl">
        <div class="flex flex-col md:flex-row md:items-start justify-between gap-6">
            <div class="space-y-3">

                @php
                    $badgeColor = match($kegiatan->jenis) {
                        'ukm'         => 'bg-violet-500/10 text-violet-400 border-violet-500/20',
                        'lomba'       => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                        'sertifikasi' => 'bg-cyan-500/10 text-cyan-400 border-cyan-500/20',
                        default       => 'bg-slate-700 text-slate-300 border-slate-600',
                    };
                @endphp
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border text-[10px] font-extrabold uppercase tracking-wider {{ $badgeColor }}">
                    @if($kegiatan->jenis === 'ukm') <i data-lucide="users" class="w-3 h-3"></i>
                    @elseif($kegiatan->jenis === 'lomba') <i data-lucide="trophy" class="w-3 h-3"></i>
                    @else <i data-lucide="badge-check" class="w-3 h-3"></i>
                    @endif
                    {{ ucfirst($kegiatan->jenis) }}
                </span>

                <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white">{{ $kegiatan->nama }}</h1>

                @if($kegiatan->penyelenggara)
                <p class="flex items-center gap-2 text-sm text-slate-400">
                    <i data-lucide="building-2" class="w-4 h-4 text-slate-500"></i>
                    {{ $kegiatan->penyelenggara }}
                </p>
                @endif
            </div>

            <div class="flex flex-wrap gap-2 shrink-0">
                @if($kegiatan->link_pendaftaran)
                <a href="{{ $kegiatan->link_pendaftaran }}" target="_blank" rel="noopener"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-slate-950 text-sm font-bold transition-all shadow-md">
                    <i data-lucide="external-link" class="w-4 h-4"></i> Daftar Sekarang
                </a>
                @endif
                <form action="{{ route('mahasiswa.bookmark.toggle', $kegiatan) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border text-sm font-semibold transition-all
                               {{ $bookmarkActive ? 'bg-amber-500/10 border-amber-500/30 text-amber-400 hover:bg-amber-500/20' : 'border-slate-700 text-slate-300 hover:bg-slate-800' }}">
                        <i data-lucide="{{ $bookmarkActive ? 'bookmark-check' : 'bookmark' }}" class="w-4 h-4"></i>
                        {{ $bookmarkActive ? 'Tersimpan' : 'Simpan' }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Grid Info --}}
    <div class="grid gap-4 md:grid-cols-2">

        {{-- Deskripsi --}}
        <div class="md:col-span-2 rounded-2xl border border-slate-800 bg-slate-900 p-6">
            <h2 class="flex items-center gap-2 text-sm font-bold text-white mb-3">
                <i data-lucide="file-text" class="w-4 h-4 text-indigo-400"></i> Deskripsi
            </h2>
            <p class="text-sm leading-relaxed text-slate-400 whitespace-pre-line">{{ $kegiatan->deskripsi ?? 'Belum ada deskripsi.' }}</p>
        </div>

        {{-- Syarat & Ketentuan --}}
        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
            <h2 class="flex items-center gap-2 text-sm font-bold text-white mb-3">
                <i data-lucide="clipboard-list" class="w-4 h-4 text-indigo-400"></i> Syarat & Ketentuan
            </h2>
            @if($kegiatan->syarat_ketentuan)
                <div class="text-sm leading-relaxed text-slate-400 whitespace-pre-line">{{ $kegiatan->syarat_ketentuan }}</div>
            @else
                <p class="text-sm text-slate-600 italic">Belum diisi.</p>
            @endif
        </div>

        {{-- Info Pendaftaran --}}
        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6 space-y-5">
            <h2 class="flex items-center gap-2 text-sm font-bold text-white">
                <i data-lucide="calendar-clock" class="w-4 h-4 text-indigo-400"></i> Info Pendaftaran
            </h2>

            {{-- Deadline --}}
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-lg bg-amber-500/10 border border-amber-500/20 flex items-center justify-center shrink-0">
                    <i data-lucide="clock" class="w-4 h-4 text-amber-400"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Deadline Pendaftaran</p>
                    @if($kegiatan->deadline_pendaftaran)
                        @php
                            $sisa = now()->diffInDays($kegiatan->deadline_pendaftaran, false);
                        @endphp
                        <p class="text-sm font-bold mt-0.5 {{ $sisa < 0 ? 'text-red-400' : ($sisa <= 7 ? 'text-amber-400' : 'text-white') }}">
                            {{ \Carbon\Carbon::parse($kegiatan->deadline_pendaftaran)->format('d M Y') }}
                        </p>
                        <p class="text-xs text-slate-500 mt-0.5">
                            @if($sisa < 0) <span class="text-red-400">Sudah berakhir</span>
                            @elseif($sisa == 0) <span class="text-amber-400">Hari ini!</span>
                            @else Sisa {{ $sisa }} hari
                            @endif
                        </p>
                    @else
                        <p class="text-sm text-slate-600 italic mt-0.5">Belum ditentukan</p>
                    @endif
                </div>
            </div>

            {{-- Link Pendaftaran --}}
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-lg bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center shrink-0">
                    <i data-lucide="link" class="w-4 h-4 text-cyan-400"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Link Pendaftaran</p>
                    @if($kegiatan->link_pendaftaran)
                        <a href="{{ $kegiatan->link_pendaftaran }}" target="_blank" rel="noopener"
                           class="text-sm text-cyan-400 hover:text-cyan-300 underline underline-offset-2 truncate block max-w-xs mt-0.5 transition-colors">
                            {{ $kegiatan->link_pendaftaran }}
                        </a>
                    @else
                        <p class="text-sm text-slate-600 italic mt-0.5">Belum tersedia</p>
                    @endif
                </div>
            </div>

            {{-- Kontak PIC --}}
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-lg bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center shrink-0">
                    <i data-lucide="contact" class="w-4 h-4 text-indigo-400"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Kontak PIC</p>
                    @if($kegiatan->kontak_pic)
                        <p class="text-sm text-white font-medium mt-0.5">{{ $kegiatan->kontak_pic }}</p>
                    @else
                        <p class="text-sm text-slate-600 italic mt-0.5">Belum tersedia</p>
                    @endif
                </div>
            </div>
        </div>

    </div>

    {{-- Status Keikutsertaan --}}
    <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
        <h2 class="flex items-center gap-2 text-sm font-bold text-white mb-5">
            <i data-lucide="activity" class="w-4 h-4 text-indigo-400"></i> Status Keikutsertaan Saya
        </h2>
        <form action="{{ route('mahasiswa.keikutsertaan.upsert', $kegiatan) }}" method="POST" class="grid gap-4 md:grid-cols-2">
            @csrf
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Status</label>
                <select name="status" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50">
                    @foreach(['berminat', 'mendaftar', 'diterima', 'selesai'] as $status)
                        <option value="{{ $status }}" @selected(optional($keikutsertaan)->status === $status)>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Catatan Pribadi</label>
                <textarea name="catatan" rows="3"
                    class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 resize-none"
                    placeholder="Rencana tindak lanjut, catatan interview, dll...">{{ old('catatan', optional($keikutsertaan)->catatan) }}</textarea>
            </div>
            <div class="md:col-span-2 flex justify-end">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl transition-all">
                    <i data-lucide="save" class="w-4 h-4"></i> Simpan Status
                </button>
            </div>
        </form>
    </div>

    {{-- Back --}}
    <div class="pb-4">
        <a href="{{ route('rekomendasi.hasil') }}"
           class="inline-flex items-center gap-2 text-xs text-slate-400 hover:text-white transition-colors">
            <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Kembali ke Hasil Rekomendasi
        </a>
    </div>

</div>
@endsection