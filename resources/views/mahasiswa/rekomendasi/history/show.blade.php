@extends('layouts.app')

@section('page_title', 'Detail Histori — ' . $hasilRekomendasi->created_at->format('d M Y'))

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6 md:p-8">
        <nav class="flex items-center gap-2 text-xs text-slate-500 mb-4">
            <a href="{{ route('mahasiswa.history.index') }}" class="hover:text-slate-300 transition-colors">Histori Rekomendasi</a>
            <span>/</span>
            <span class="text-slate-300">{{ $hasilRekomendasi->created_at->format('d M Y, H:i') }}</span>
        </nav>
        <p class="text-xs font-bold uppercase tracking-[0.25em] text-cyan-400">Detail Sesi</p>
        <h1 class="mt-3 text-3xl font-extrabold tracking-tight text-white">{{ $hasilRekomendasi->created_at->format('d M Y, H:i') }}</h1>
        <p class="mt-3 text-sm text-slate-400">Breakdown lengkap skor SAW. Klik kegiatan untuk lihat detail, syarat, dan link pendaftaran.</p>
    </div>

    {{-- Input Preferensi --}}
    <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
        <h2 class="text-sm font-bold uppercase tracking-wider text-slate-400 mb-4">Input Preferensi</h2>
        @php $pref = $hasilRekomendasi->preferensi ?? []; @endphp
        <div class="grid gap-3 md:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl bg-slate-950 border border-slate-800 p-4">
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Minat Teknis</p>
                <p class="mt-1 text-sm text-white font-medium">{{ implode(', ', $pref['minat_teknis'] ?? []) ?: '-' }}</p>
            </div>
            <div class="rounded-xl bg-slate-950 border border-slate-800 p-4">
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Target Karir</p>
                <p class="mt-1 text-sm text-white font-medium">{{ $pref['target_karir'] ?? '-' }}</p>
            </div>
            <div class="rounded-xl bg-slate-950 border border-slate-800 p-4">
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Waktu Luang</p>
                <p class="mt-1 text-sm text-white font-medium">{{ $pref['waktu_luang'] ?? '-' }}</p>
            </div>
            <div class="rounded-xl bg-slate-950 border border-slate-800 p-4">
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Tujuan</p>
                <p class="mt-1 text-sm text-white font-medium">{{ $pref['tujuan'] ?? '-' }}</p>
            </div>
        </div>
    </div>

    {{-- Top 3 --}}
    <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
        <h2 class="text-sm font-bold uppercase tracking-wider text-slate-400 mb-4">🏆 Top 3 Rekomendasi</h2>
        <div class="grid gap-4 md:grid-cols-3">
            @foreach($hasilRekomendasi->top_tiga ?? [] as $item)
                @php $kegiatan = \App\Models\Kegiatan::find($item['kegiatan_id'] ?? null); @endphp
                <div class="rounded-xl border {{ ($item['ranking'] ?? 0) === 1 ? 'border-indigo-500/40 bg-indigo-950/20' : 'border-slate-800 bg-slate-950' }} p-5 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-bold uppercase tracking-wider {{ ($item['ranking'] ?? 0) === 1 ? 'text-indigo-400' : 'text-cyan-400' }}">
                            {{ ($item['ranking'] ?? 0) === 1 ? '🏆 ' : '' }}Rank {{ $item['ranking'] ?? '-' }}
                        </span>
                        <span class="text-xs font-bold text-indigo-400">{{ number_format($item['skor'] ?? 0, 4) }}</span>
                    </div>
                    <div>
                        <p class="font-bold text-white text-sm leading-snug">{{ $item['nama'] ?? '-' }}</p>
                        <p class="text-xs text-slate-400 mt-0.5">{{ ucfirst($item['jenis'] ?? '-') }}</p>
                    </div>
                    @if($kegiatan)
                        @if($kegiatan->deadline_pendaftaran)
                            @php $sisa = now()->diffInDays($kegiatan->deadline_pendaftaran, false); @endphp
                            <p class="text-xs flex items-center gap-1 {{ $sisa < 0 ? 'text-red-400' : ($sisa <= 7 ? 'text-amber-400' : 'text-slate-400') }}">
                                <i data-lucide="clock" class="w-3 h-3"></i>
                                @if($sisa < 0) Sudah berakhir
                                @elseif($sisa === 0) Deadline hari ini!
                                @else {{ \Carbon\Carbon::parse($kegiatan->deadline_pendaftaran)->format('d M Y') }} ({{ $sisa }} hari)
                                @endif
                            </p>
                        @endif
                        @if($kegiatan->kontak_pic)
                            <p class="text-xs text-slate-400 flex items-center gap-1">
                                <i data-lucide="contact" class="w-3 h-3 text-slate-500"></i>
                                {{ $kegiatan->kontak_pic }}
                            </p>
                        @endif
                        <div class="flex flex-wrap gap-1.5 pt-1">
                            <a href="{{ route('mahasiswa.kegiatan.show', $kegiatan) }}"
                               class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-slate-700 hover:border-indigo-500/50 text-slate-300 hover:text-indigo-300 text-[11px] font-semibold transition-all">
                                <i data-lucide="info" class="w-3 h-3"></i> Detail
                            </a>
                            @if($kegiatan->link_pendaftaran)
                            <a href="{{ $kegiatan->link_pendaftaran }}" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 hover:bg-cyan-500/20 text-[11px] font-semibold transition-all">
                                <i data-lucide="external-link" class="w-3 h-3"></i> Daftar
                            </a>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    {{-- Breakdown Lengkap --}}
    <div class="space-y-2">
    @foreach($hasilRekomendasi->hasil_detail ?? [] as $item)
        @php $kegiatan = \App\Models\Kegiatan::find($item['kegiatan_id'] ?? null); @endphp
        <div class="rounded-xl border border-slate-800 bg-slate-950 px-4 py-3 flex flex-row items-center justify-between gap-4">

            {{-- Kiri: Rank + Nama --}}
            <div class="flex items-center gap-3 flex-1 min-w-0">
                <div class="w-8 h-8 rounded-lg shrink-0 flex items-center justify-center text-[11px] font-black
                    {{ ($item['ranking'] ?? 0) === 1 ? 'bg-indigo-600 text-white' : 'bg-slate-900 border border-slate-800 text-slate-400' }}">
                    #{{ $item['ranking'] ?? '-' }}
                </div>
                <div class="min-w-0">
                    <p class="font-semibold text-white text-sm truncate">{{ $item['nama'] ?? '-' }}</p>
                    <p class="text-xs text-slate-400">{{ ucfirst($item['jenis'] ?? '-') }}</p>
                </div>
            </div>

            {{-- Kanan: Skor + Progress + Tombol --}}
            <div class="flex items-center gap-3 shrink-0">
                @php
                    $skorMaks = $hasilRekomendasi->hasil_detail[0]['skor'] ?? 1;
                    $lebar    = $skorMaks > 0 ? (($item['skor'] ?? 0) / $skorMaks) * 100 : 0;
                @endphp
                <div class="flex flex-col items-end w-28 gap-1">
                    <span class="text-xs font-bold text-indigo-400">{{ number_format($item['skor'] ?? 0, 4) }}</span>
                    <div class="w-full h-1.5 bg-slate-900 rounded-full overflow-hidden">
                        <div class="h-full rounded-full {{ ($item['ranking'] ?? 0) === 1 ? 'bg-indigo-500' : 'bg-indigo-400/50' }}"
                             style="width: {{ round($lebar, 2) }}%"></div>
                    </div>
                </div>
                @if($kegiatan)
                    <a href="{{ route('mahasiswa.kegiatan.show', $kegiatan) }}"
                       class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-slate-700 hover:border-indigo-500/50 text-slate-300 hover:text-indigo-300 text-[11px] font-semibold transition-all shrink-0">
                        <i data-lucide="info" class="w-3 h-3"></i> Detail
                    </a>
                @endif
            </div>

        </div>
    @endforeach
</div>

    {{-- Back --}}
    <div class="pb-4">
        <a href="{{ route('mahasiswa.history.index') }}"
           class="inline-flex items-center gap-2 text-xs text-slate-400 hover:text-white transition-colors">
            <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Kembali ke Histori
        </a>
    </div>

</div>
@endsection