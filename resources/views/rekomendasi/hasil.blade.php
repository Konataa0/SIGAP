@extends('layouts.app')

@section('page_title', 'Hasil Rekomendasi SAW')

@section('content')
<div class="max-w-5xl mx-auto space-y-8 px-4 sm:px-0">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-slate-800 pb-6">
        <div>
            <h3 class="text-xl font-extrabold text-white mb-1 tracking-tight">Hasil Perangkingan Alternatif Kegiatan</h3>
            <p class="text-sm text-slate-400">
                Berdasarkan kalkulasi bobot preferensimu menggunakan metode
                <span class="text-indigo-400 font-semibold">Simple Additive Weighting (SAW)</span>.
            </p>
        </div>
        <div class="flex flex-wrap gap-2 shrink-0">
            <a href="{{ route('rekomendasi.form') }}"
               class="inline-flex items-center gap-2 bg-slate-900 border border-slate-800 hover:bg-slate-800 text-slate-300 px-4 py-2.5 rounded-xl text-xs font-semibold transition-all">
                <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i> Hitung Ulang
            </a>
            <a href="{{ route('mahasiswa.history.index') }}"
               class="inline-flex items-center gap-2 bg-cyan-500 text-slate-950 px-4 py-2.5 rounded-xl text-xs font-semibold transition-all">
                <i data-lucide="history" class="w-3.5 h-3.5"></i> Lihat Histori
            </a>
        </div>
    </div>

    @if(empty($hasil))
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-12 text-center space-y-4">
            <i data-lucide="inbox" class="w-10 h-10 mx-auto text-slate-700"></i>
            <p class="text-slate-400 font-semibold">Belum ada hasil rekomendasi.</p>
            <a href="{{ route('rekomendasi.form') }}"
               class="inline-flex items-center gap-2 mt-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl transition-all">
                <i data-lucide="sliders" class="w-4 h-4"></i> Isi Form Sekarang
            </a>
        </div>
    @else

        {{-- ===== RANK #1 HERO ===== --}}
        @php $top = $hasil[0]; @endphp
        <div class="relative overflow-hidden bg-gradient-to-br from-indigo-950/30 via-slate-900/50 to-slate-950 border border-indigo-500/30 rounded-2xl p-6 md:p-8 shadow-xl">
            <div class="absolute right-0 top-0 w-64 h-64 bg-indigo-500/10 blur-3xl rounded-full -mr-16 -mt-16 pointer-events-none"></div>

            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 relative z-10">
                <div class="space-y-3 w-full md:max-w-2xl">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-400 text-[10px] font-extrabold uppercase border border-indigo-500/20 tracking-wider">
                        🏆 REKOMENDASI UTAMA (RANK #1)
                    </span>

                    <h4 class="text-xl md:text-2xl font-black text-white leading-tight tracking-tight">
                        {{ $top['kegiatan']->nama }}
                    </h4>

                    <div class="flex flex-wrap items-center gap-2 text-xs text-slate-400">
                        <span class="flex items-center gap-1.5 bg-slate-900/60 px-2.5 py-1 rounded-md border border-slate-800">
                            <i data-lucide="layers" class="w-3.5 h-3.5 text-indigo-400"></i>
                            {{ ucfirst($top['kegiatan']->jenis) }}
                        </span>
                        @if($top['kegiatan']->penyelenggara)
                        <span class="flex items-center gap-1.5 bg-slate-900/60 px-2.5 py-1 rounded-md border border-slate-800">
                            <i data-lucide="building-2" class="w-3.5 h-3.5 text-indigo-400"></i>
                            {{ $top['kegiatan']->penyelenggara }}
                        </span>
                        @endif
                        @if($top['kegiatan']->deadline_pendaftaran)
                        <span class="flex items-center gap-1.5 bg-amber-500/10 px-2.5 py-1 rounded-md border border-amber-500/20 text-amber-400">
                            <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                            Deadline: {{ $top['kegiatan']->deadline_pendaftaran->format('d M Y') }}
                        </span>
                        @endif
                    </div>

                    @if($top['kegiatan']->deskripsi)
                        <p class="text-sm text-slate-400 leading-relaxed">{{ Str::limit($top['kegiatan']->deskripsi, 180) }}</p>
                    @endif

                    <div class="flex flex-wrap gap-2 pt-1">
                        <a href="{{ route('mahasiswa.kegiatan.show', $top['kegiatan']) }}"
                           class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-lg transition-all">
                            <i data-lucide="info" class="w-3.5 h-3.5"></i> Detail & Simpan
                        </a>
                        @if($top['kegiatan']->link_pendaftaran)
                        <a href="{{ $top['kegiatan']->link_pendaftaran }}" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-1.5 px-4 py-2 bg-cyan-500 hover:bg-cyan-400 text-slate-950 text-xs font-bold rounded-lg transition-all">
                            <i data-lucide="external-link" class="w-3.5 h-3.5"></i> Daftar Sekarang
                        </a>
                        @endif
                    </div>
                </div>

                <div class="bg-gradient-to-b from-indigo-600 to-indigo-700 px-6 py-5 rounded-2xl text-center shadow-lg shrink-0 w-full md:w-40 border border-indigo-400/20">
                    <span class="text-[10px] font-bold text-indigo-200 uppercase tracking-widest block mb-1">SKOR SAW</span>
                    <span class="text-3xl font-black text-white tracking-tight">{{ number_format($top['skor'], 3) }}</span>
                </div>
            </div>
        </div>

        {{-- ===== RANKING LIST ===== --}}
        <div class="space-y-3">
            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Urutan Rekomendasi Lainnya</h4>

            @foreach($hasil as $row)
            <div class="bg-slate-900/40 border {{ $row['ranking'] === 1 ? 'border-indigo-500/40 bg-indigo-950/10' : 'border-slate-800/80' }} rounded-xl p-4 hover:border-slate-700 hover:bg-slate-900/80 transition-all w-full">
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">

                    {{-- Rank + Info --}}
                    <div class="flex items-center gap-4 flex-1 min-w-0">
                        <div class="w-10 h-10 rounded-xl shrink-0 flex items-center justify-center text-xs font-black
                            {{ $row['ranking'] === 1 ? 'bg-indigo-600 text-white' : 'bg-slate-950 border border-slate-800 text-slate-400' }}">
                            #{{ $row['ranking'] }}
                        </div>
                        <div class="min-w-0">
                            <h5 class="text-sm font-bold text-white truncate">{{ $row['kegiatan']->nama }}</h5>
                            <div class="flex flex-wrap items-center gap-2 text-[11px] text-slate-400 mt-0.5">
                                <span>{{ ucfirst($row['kegiatan']->jenis) }}</span>
                                @if($row['kegiatan']->penyelenggara)
                                    <span class="text-slate-600">•</span>
                                    <span>{{ $row['kegiatan']->penyelenggara }}</span>
                                @endif
                                @if($row['kegiatan']->deadline_pendaftaran)
                                    <span class="text-slate-600">•</span>
                                    <span class="text-amber-400/80 flex items-center gap-0.5">
                                        <i data-lucide="clock" class="w-3 h-3"></i>
                                        {{ $row['kegiatan']->deadline_pendaftaran->format('d M Y') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Skor + Tombol --}}
                    <div class="flex items-center gap-3 shrink-0 border-t border-slate-800/60 sm:border-t-0 pt-3 sm:pt-0">
                        <div class="flex flex-col items-end w-32 space-y-1.5">
                            <div class="flex justify-between w-full text-[11px]">
                                <span class="text-slate-500">V<sub>i</sub></span>
                                <span class="text-indigo-400 font-bold">{{ number_format($row['skor'], 4) }}</span>
                            </div>
                            <div class="w-full h-1.5 bg-slate-950 rounded-full overflow-hidden border border-slate-800/60">
                                @php $lebar = $hasil[0]['skor'] > 0 ? ($row['skor'] / $hasil[0]['skor']) * 100 : 0; @endphp
                                <div class="h-full rounded-full {{ $row['ranking'] === 1 ? 'bg-indigo-500' : 'bg-indigo-400/60' }}"
                                    style="width: {{ round($lebar, 2) }}%"></div>
                            </div>
                        </div>

                        <a href="{{ route('mahasiswa.kegiatan.show', $row['kegiatan']) }}"
                           class="inline-flex items-center gap-1 px-3 py-2 rounded-lg border border-slate-700 hover:border-indigo-500/50 hover:bg-indigo-950/20 text-slate-300 hover:text-indigo-300 text-[11px] font-semibold transition-all">
                            <i data-lucide="info" class="w-3.5 h-3.5"></i> Detail
                        </a>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

    @endif
</div>
@endsection