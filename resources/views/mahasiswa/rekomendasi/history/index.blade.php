@extends('layouts.app')

@section('page_title', 'Histori Rekomendasi')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6 md:p-8">
        <p class="text-xs font-bold uppercase tracking-[0.25em] text-cyan-400">Histori SAW</p>
        <h1 class="mt-3 text-3xl font-extrabold tracking-tight text-white">Riwayat Rekomendasi</h1>
        <p class="mt-3 max-w-3xl text-sm leading-relaxed text-slate-400">
            Setiap sesi rekomendasi tersimpan lengkap bersama input preferensi dan tiga hasil teratas.
            Klik kegiatan untuk melihat detail, syarat, deadline, dan link pendaftaran.
        </p>
    </div>

    <div class="space-y-4">
        @forelse($histori as $sesi)
            @php $preferensi = $sesi->preferensi ?? []; @endphp

            <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5 space-y-4">

                <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                    <div>
                        <p class="text-sm font-bold text-white flex items-center gap-2">
                            <i data-lucide="calendar" class="w-3.5 h-3.5 text-slate-500"></i>
                            {{ $sesi->created_at->format('d M Y, H:i') }}
                        </p>
                        <div class="mt-1 flex flex-wrap gap-x-3 gap-y-0.5 text-xs text-slate-400">
                            <span>Minat: {{ implode(', ', $preferensi['minat_teknis'] ?? []) ?: '-' }}</span>
                            <span class="text-slate-600">•</span>
                            <span>{{ $preferensi['target_karir'] ?? '-' }}</span>
                            <span class="text-slate-600">•</span>
                            <span>{{ $preferensi['waktu_luang'] ?? '-' }}</span>
                            <span class="text-slate-600">•</span>
                            <span>{{ $preferensi['tujuan'] ?? '-' }}</span>
                        </div>
                    </div>
                    <a href="{{ route('mahasiswa.history.show', $sesi) }}"
                       class="shrink-0 rounded-xl bg-slate-800 hover:bg-slate-700 border border-slate-700 px-4 py-2.5 text-xs font-bold text-slate-200 inline-flex items-center gap-1.5 transition-all">
                        <i data-lucide="bar-chart-2" class="w-3.5 h-3.5"></i> Lihat Breakdown SAW
                    </a>
                </div>

                <div class="grid gap-3 md:grid-cols-3">
                    @foreach(array_slice($sesi->top_tiga ?? [], 0, 3) as $item)
                        @php $kegiatan = \App\Models\Kegiatan::find($item['kegiatan_id'] ?? null); @endphp
                        <div class="rounded-xl border border-slate-800 bg-slate-950 p-4 space-y-2">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-cyan-400">
                                @if(($item['ranking'] ?? 0) === 1) 🏆 @endif Rank {{ $item['ranking'] ?? '-' }}
                            </p>
                            <p class="font-semibold text-white text-sm leading-snug">{{ $item['nama'] ?? '-' }}</p>
                            <p class="text-xs text-slate-400">
                                {{ ucfirst($item['jenis'] ?? '-') }} •
                                Skor <span class="text-indigo-400 font-bold">{{ number_format($item['skor'] ?? 0, 4) }}</span>
                            </p>
                            @if($kegiatan)
                                <div class="flex flex-wrap gap-1.5 pt-1">
                                    <a href="{{ route('mahasiswa.kegiatan.show', $kegiatan) }}"
                                       class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-slate-900 border border-slate-700 hover:border-indigo-500/50 text-slate-300 hover:text-indigo-300 text-[10px] font-semibold transition-all">
                                        <i data-lucide="info" class="w-3 h-3"></i> Detail
                                    </a>
                                    @if($kegiatan->link_pendaftaran)
                                    <a href="{{ $kegiatan->link_pendaftaran }}" target="_blank" rel="noopener"
                                       class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 hover:bg-cyan-500/20 text-[10px] font-semibold transition-all">
                                        <i data-lucide="external-link" class="w-3 h-3"></i> Daftar
                                    </a>
                                    @endif
                                </div>
                                @if($kegiatan->deadline_pendaftaran)
                                    @php $sisa = now()->diffInDays($kegiatan->deadline_pendaftaran, false); @endphp
                                    <p class="text-[10px] {{ $sisa < 0 ? 'text-red-400' : ($sisa <= 7 ? 'text-amber-400' : 'text-slate-500') }}">
                                        <i data-lucide="clock" class="w-3 h-3 inline"></i>
                                        @if($sisa < 0) Sudah berakhir
                                        @elseif($sisa === 0) Deadline hari ini!
                                        @else {{ \Carbon\Carbon::parse($kegiatan->deadline_pendaftaran)->format('d M Y') }} ({{ $sisa }} hari lagi)
                                        @endif
                                    </p>
                                @endif
                            @endif
                        </div>
                    @endforeach
                </div>

            </div>
        @empty
            <div class="rounded-2xl border border-slate-800 bg-slate-900 p-12 text-center space-y-3">
                <i data-lucide="inbox" class="w-10 h-10 mx-auto text-slate-700"></i>
                <p class="text-slate-400 font-semibold">Belum ada histori rekomendasi.</p>
                <a href="{{ route('rekomendasi.form') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl transition-all">
                    <i data-lucide="sliders" class="w-4 h-4"></i> Mulai Analisis
                </a>
            </div>
        @endforelse
    </div>

</div>
@endsection