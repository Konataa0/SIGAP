@extends('layouts.app')

@section('page_title', 'Histori Rekomendasi')

@section('content')
<div class="space-y-6">
    <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6 md:p-8">
        <p class="text-xs font-bold uppercase tracking-[0.25em] text-cyan-400">Histori SAW</p>
        <h1 class="mt-3 text-3xl font-extrabold tracking-tight text-white">Riwayat Rekomendasi</h1>
        <p class="mt-3 max-w-3xl text-sm leading-relaxed text-slate-400">Setiap sesi rekomendasi tersimpan bersama input preferensi dan tiga hasil teratas.</p>
    </div>

    <div class="space-y-4">
        @forelse($histori as $sesi)
            @php $preferensi = $sesi->preferensi ?? []; @endphp
            <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
                <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                    <div>
                        <p class="text-sm font-bold text-white">{{ $sesi->created_at->format('d M Y, H:i') }}</p>
                        <p class="text-xs text-slate-400">Minat: {{ implode(', ', $preferensi['minat_teknis'] ?? []) ?: '-' }}</p>
                        <p class="text-xs text-slate-400">Target: {{ $preferensi['target_karir'] ?? '-' }} | Waktu: {{ $preferensi['waktu_luang'] ?? '-' }} | Tujuan: {{ $preferensi['tujuan'] ?? '-' }}</p>
                    </div>
                    <a href="{{ route('mahasiswa.history.show', $sesi) }}" class="rounded-xl bg-cyan-500 px-4 py-2.5 text-sm font-bold text-slate-950">Lihat Detail</a>
                </div>
                <div class="mt-4 grid gap-3 md:grid-cols-3">
                    @foreach(array_slice($sesi->top_tiga ?? [], 0, 3) as $item)
                        <div class="rounded-xl border border-slate-800 bg-slate-950 p-4">
                            <p class="text-xs font-bold uppercase tracking-wider text-cyan-400">Rank {{ $item['ranking'] ?? '-' }}</p>
                            <p class="mt-1 font-semibold text-white">{{ $item['nama'] ?? '-' }}</p>
                            <p class="text-xs text-slate-400">Skor: {{ number_format($item['skor'] ?? 0, 4) }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="rounded-2xl border border-slate-800 bg-slate-900 p-8 text-slate-400">Belum ada histori rekomendasi.</div>
        @endforelse
    </div>
</div>
@endsection
