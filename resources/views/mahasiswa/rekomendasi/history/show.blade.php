@extends('layouts.app')

@section('page_title', 'Detail Histori Rekomendasi')

@section('content')
<div class="space-y-6">
    <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6 md:p-8">
        <p class="text-xs font-bold uppercase tracking-[0.25em] text-cyan-400">Detail Sesi</p>
        <h1 class="mt-3 text-3xl font-extrabold tracking-tight text-white">{{ $hasilRekomendasi->created_at->format('d M Y, H:i') }}</h1>
        <p class="mt-3 max-w-3xl text-sm leading-relaxed text-slate-400">Breakdown lengkap skor SAW untuk sesi rekomendasi ini.</p>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <h2 class="text-sm font-bold uppercase tracking-wider text-slate-400">Input Preferensi</h2>
            <pre class="mt-4 overflow-auto rounded-xl bg-slate-950 p-4 text-xs text-slate-300">{{ json_encode($hasilRekomendasi->preferensi, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
        </div>
        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
            <h2 class="text-sm font-bold uppercase tracking-wider text-slate-400">Top 3</h2>
            <div class="mt-4 space-y-3">
                @foreach($hasilRekomendasi->top_tiga ?? [] as $item)
                    <div class="rounded-xl border border-slate-800 bg-slate-950 p-4">
                        <p class="font-semibold text-white">{{ $item['nama'] ?? '-' }}</p>
                        <p class="text-xs text-slate-400">Rank {{ $item['ranking'] ?? '-' }} | Skor {{ number_format($item['skor'] ?? 0, 4) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
        <h2 class="text-sm font-bold uppercase tracking-wider text-slate-400">Breakdown Lengkap</h2>
        <div class="mt-4 grid gap-3">
            @foreach($hasilRekomendasi->hasil_detail ?? [] as $item)
                <div class="rounded-xl border border-slate-800 bg-slate-950 p-4 flex flex-col gap-1 md:flex-row md:items-center md:justify-between">
                    <div>
                        <p class="font-semibold text-white">#{{ $item['ranking'] ?? '-' }} {{ $item['nama'] ?? '-' }}</p>
                        <p class="text-xs text-slate-400">Kategori: {{ ucfirst($item['jenis'] ?? '-') }}</p>
                    </div>
                    <p class="text-sm font-bold text-cyan-400">{{ number_format($item['skor'] ?? 0, 4) }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
