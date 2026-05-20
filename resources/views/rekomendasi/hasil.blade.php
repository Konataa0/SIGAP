@extends('layouts.app')

@section('page_title', 'Hasil Rekomendasi SAW')

@section('content')
<div class="max-w-5xl mx-auto space-y-8 px-4 sm:px-0">

    {{-- Header Panel --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-slate-800 pb-6">
        <div>
            <h3 class="text-xl font-extrabold text-white mb-1 tracking-tight">Hasil Perangkingan Alternatif Kegiatan</h3>
            <p class="text-sm text-slate-400">
                Berdasarkan kalkulasi bobot preferensimu terhadap kriteria kelayakan menggunakan metode 
                <span class="text-indigo-400 font-semibold">Simple Additive Weighting (SAW)</span>.
            </p>
        </div>
        <a href="{{ route('rekomendasi.form') }}"
           class="inline-flex items-center gap-2 bg-slate-900 border border-slate-800 hover:bg-slate-800 text-slate-300 px-4 py-2.5 rounded-xl text-xs font-semibold transition-all shadow-md shrink-0 w-fit">
            <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i> Hitung Ulang Preferensi
        </a>
    </div>

    @if(empty($hasil))
        {{-- State: Belum Ada Data --}}
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-12 text-center space-y-4">
            <i data-lucide="inbox" class="w-10 h-10 mx-auto text-slate-700"></i>
            <p class="text-slate-400 font-semibold">Belum ada hasil rekomendasi.</p>
            <p class="text-slate-500 text-sm">Silakan isi form preferensi terlebih dahulu.</p>
            <a href="{{ route('rekomendasi.form') }}"
               class="inline-flex items-center gap-2 mt-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-indigo-600/10">
                <i data-lucide="sliders" class="w-4 h-4"></i> Isi Form Sekarang
            </a>
        </div>
    @else
        {{-- ===== RANK #1 — HERO HIGHLIGHT CONTAINER ===== --}}
        @php $top = $hasil[0]; @endphp
        <div class="relative overflow-hidden bg-gradient-to-br from-indigo-950/30 via-slate-900/50 to-slate-950 border border-indigo-500/30 rounded-2xl p-6 md:p-8 shadow-xl shadow-indigo-500/5">
            <div class="absolute right-0 top-0 w-64 h-64 bg-indigo-500/10 blur-3xl rounded-full -mr-16 -mt-16 pointer-events-none"></div>

            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 relative z-10">
                <div class="space-y-3 w-full md:max-w-2xl">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-400 text-[10px] font-extrabold uppercase border border-indigo-500/20 tracking-wider">
                        🏆 REKOMENDASI UTAMA (RANK #1)
                    </span>

                    <h4 class="text-xl md:text-2xl font-black text-white leading-tight tracking-tight">
                        {{ $top['kegiatan']->nama }}
                    </h4>

                    <div class="flex flex-wrap items-center gap-4 text-xs text-slate-400">
                        <span class="flex items-center gap-1.5 bg-slate-900/60 px-2.5 py-1 rounded-md border border-slate-800">
                            <i data-lucide="layers" class="w-3.5 h-3.5 text-indigo-400"></i>
                            Kategori: {{ ucfirst($top['kegiatan']->jenis) }}
                        </span>
                        @if($top['kegiatan']->penyelenggara)
                        <span class="flex items-center gap-1.5 bg-slate-900/60 px-2.5 py-1 rounded-md border border-slate-800">
                            <i data-lucide="building-2" class="w-3.5 h-3.5 text-indigo-400"></i>
                            {{ $top['kegiatan']->penyelenggara }}
                        </span>
                        @endif
                    </div>

                    @if($top['kegiatan']->deskripsi)
                        <p class="text-sm text-slate-400 leading-relaxed pt-1">{{ $top['kegiatan']->deskripsi }}</p>
                    @endif
                </div>

                {{-- Card Skor Utama --}}
                <div class="bg-gradient-to-b from-indigo-600 to-indigo-700 px-6 py-5 rounded-2xl text-center shadow-lg shadow-indigo-600/20 shrink-0 w-full md:w-40 border border-indigo-400/20">
                    <span class="text-[10px] font-bold text-indigo-200 uppercase tracking-widest block mb-1">SKOR AKHIR SAW</span>
                    <span class="text-3xl font-black text-white tracking-tight">{{ number_format($top['skor'], 3) }}</span>
                </div>
            </div>
        </div>

        {{-- ===== LIST URUTAN REKOMENDASI LAINNYA ===== --}}
        <div class="space-y-4 pt-2">
            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Urutan Rekomendasi Lainnya</h4>

            {{-- Pembungkus utama bertipe Flex Vertikal agar tersusun rapi ke bawah --}}
            <div class="flex flex-col gap-3 w-full">
                @foreach($hasil as $row)
                <div class="bg-slate-900/40 border {{ $row['ranking'] === 1 ? 'border-indigo-500/40 bg-indigo-950/10' : 'border-slate-800/80' }} rounded-xl p-4 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 hover:border-slate-700 hover:bg-slate-900/80 transition-all duration-200 w-full">
                    
                    {{-- Bagian Kiri: Angka Rank & Info Judul Alternatif --}}
                    <div class="flex items-center gap-4 flex-1">
                        {{-- Badge Angka Ranking --}}
                        <div class="w-10 h-10 rounded-xl shrink-0 flex items-center justify-center text-xs font-black tracking-tight shadow-inner
                            {{ $row['ranking'] === 1 ? 'bg-indigo-600 text-white shadow-indigo-400/20' : 'bg-slate-950 border border-slate-800 text-slate-400' }}">
                            #{{ $row['ranking'] }}
                        </div>

                        <div class="space-y-0.5">
                            <h5 class="text-sm font-bold text-white tracking-tight leading-snug">{{ $row['kegiatan']->nama }}</h5>
                            <div class="flex items-center flex-wrap gap-2 text-[11px] text-slate-400">
                                <span class="text-slate-400">{{ ucfirst($row['kegiatan']->jenis) }}</span>
                                @if($row['kegiatan']->penyelenggara)
                                    <span class="text-slate-600">•</span>
                                    <span class="text-slate-500">{{ $row['kegiatan']->penyelenggara }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Kanan: Progress Bar Linear (Nilai Vi) --}}
                    <div class="w-full sm:w-60 flex items-center justify-between sm:justify-end gap-4 shrink-0 border-t border-slate-800/60 sm:border-t-0 pt-3 sm:pt-0">
                        <div class="flex flex-col sm:items-end flex-1 sm:flex-none w-full sm:w-44 space-y-1.5">
                            <div class="flex justify-between w-full text-[11px] font-medium">
                                <span class="text-slate-500">Nilai V<sub>i</sub></span>
                                <span class="text-indigo-400 font-bold tracking-wide">{{ number_format($row['skor'], 4) }}</span>
                            </div>
                            {{-- Trek Progress Bar --}}
                            <div class="w-full h-1.5 bg-slate-950 rounded-full overflow-hidden border border-slate-800/60">
                                @php $lebar = $hasil[0]['skor'] > 0 ? ($row['skor'] / $hasil[0]['skor']) * 100 : 0; @endphp
                                <div class="h-full rounded-full transition-all duration-500
                                    {{ $row['ranking'] === 1 ? 'bg-indigo-500' : 'bg-indigo-400/60' }}"
                                     @style(['width: ' . round($lebar, 2) . '%'])>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection