@extends('layouts.app')

@section('page_title', 'Hasil Rekomendasi Sistem (SAW)')

@section('content')
<div class="max-w-5xl mx-auto space-y-8">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-slate-800 pb-6">
        <div>
            <h3 class="text-xl font-extrabold text-white mb-1">Hasil Perangkingan Alternatif Kegiatan</h3>
            <p class="text-sm text-slate-400">Berdasarkan kalkulasi bobot preferensimu terhadap kriteria kelayakan menggunakan metode SAW.</p>
        </div>
        <a href="{{ route('rekomendasi.form') }}" class="inline-flex items-center gap-2 bg-slate-900 border border-slate-800 hover:bg-slate-800 text-slate-300 px-4 py-2 rounded-xl text-xs font-semibold transition-all w-fit">
            <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i> Hitung Ulang Preferensi
        </a>
    </div>

    @php
        // Ini adalah cetakan variabel simulasi agar UI/UX langsung kelihatan bentuknya di browser kamu.
        // Jika backend temanmu sudah melempar variabel $hasil_rekomendasi, data array ini bisa dihapus.
        $kegiatan_dummy = [
            ['nama' => 'Sertifikasi Cisco CyberOps Associate', 'kategori' => 'Sertifikasi Internasional', 'skor' => 0.985, 'status' => 'Sangat Direkomendasikan'],
            ['nama' => 'UKM Programming & Mobile Apps Developer', 'kategori' => 'Unit Kegiatan Mahasiswa', 'skor' => 0.854, 'status' => 'Direkomendasikan'],
            ['nama' => 'Lomba Pagelaran Mahasiswa Nasional Bidang TIK (GEMASTIK)', 'kategori' => 'Kompetisi / Lomba', 'skor' => 0.721, 'status' => 'Cukup Sesuai']
        ];
    @endphp

    <div class="relative overflow-hidden bg-gradient-to-br from-indigo-950/40 via-slate-900 to-slate-900 border-2 border-indigo-500/30 rounded-2xl p-6 md:p-8 shadow-xl shadow-indigo-500/5">
        <div class="absolute right-0 top-0 w-64 h-64 bg-indigo-500/10 blur-3xl rounded-full -mr-16 -mt-16 pointer-events-none"></div>
        
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 relative z-10">
            <div class="space-y-3">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-400 text-[10px] font-extrabold uppercase border border-indigo-500/20 tracking-wider">
                    🏆 Rekomendasi Utama (Rank #1)
                </span>
                <h4 class="text-xl md:text-2xl font-black text-white leading-tight">
                    {{ $kegiatan_dummy[0]['nama'] }}
                </h4>
                <div class="flex items-center gap-4 text-xs text-slate-400">
                    <span class="flex items-center gap-1.5"><i data-lucide="layers" class="w-3.5 h-3.5 text-indigo-400"></i> Kategori: {{ $kegiatan_dummy[0]['kategori'] }}</span>
                </div>
            </div>
            
            <div class="bg-indigo-600 px-6 py-4 rounded-xl text-center shadow-lg shadow-indigo-600/20 shrink-0 w-full md:w-auto">
                <span class="text-[10px] font-bold text-indigo-200 uppercase tracking-widest block mb-0.5">Skor Akhir SAW</span>
                <span class="text-2xl font-black text-white tracking-tight">{{ $kegiatan_dummy[0]['skor'] }}</span>
            </div>
        </div>
    </div>

    <div class="space-y-4">
        <h4 class="text-sm font-bold text-slate-400 uppercase tracking-widest">Urutan Rekomendasi Lainnya</h4>
        
        <div class="grid grid-cols-1 gap-3">
            @foreach($kegiatan_dummy as $index => $keg)
            <div class="bg-slate-900 border border-slate-800 rounded-xl p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 hover:border-slate-700 transition-all">
                <div class="flex items-center gap-4 w-full sm:w-auto">
                    <div class="w-8 h-8 rounded-lg bg-slate-950 border border-slate-800 flex items-center justify-center text-xs font-bold text-slate-300 shrink-0">
                        #{{ $index + 1 }}
                    </div>
                    <div>
                        <h5 class="text-sm font-bold text-white mb-0.5">{{ $keg['nama'] }}</h5>
                        <span class="text-xs text-slate-500 block">{{ $keg['kategori'] }}</span>
                    </div>
                </div>

                <div class="w-full sm:w-48 space-y-1.5 shrink-0">
                    <div class="flex justify-between text-[11px] font-semibold">
                        <span class="text-slate-400">Nilai V<sub>i</sub></span>
                        <span class="text-indigo-400 font-bold">{{ $keg['skor'] }}</span>
                    </div>
                    <div class="w-full h-2 bg-slate-950 rounded-full overflow-hidden border border-slate-800">
                        <div class="h-full bg-indigo-500 rounded-full transition-all" style="width: {{ $keg['skor'] * 100 }}%"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection