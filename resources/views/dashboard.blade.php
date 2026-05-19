@extends('layouts.app')

@section('title', 'SIGAP - Dashboard Panel')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-2 md:space-y-0">
        <h1 class="text-2xl font-bold text-white tracking-wide">Dashboard Utama Mahasiswa</h1>
        <span class="px-3 py-1 bg-slate-800 text-slate-400 border border-slate-700 text-xs rounded-full font-medium">
            Semester Berjalan: Gasal 2026
        </span>
    </div>

    <div class="relative overflow-hidden bg-gradient-to-r from-violet-900/60 to-indigo-900/60 border border-indigo-500/30 rounded-2xl p-6 md:p-8 backdrop-blur-sm shadow-xl">
        <div class="relative z-10 max-w-2xl">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-2 flex items-center gap-3">
                Selamat Datang di SIGAP Panel, Bro! 👋
            </h2>
            <p class="text-indigo-200/80 text-sm md:text-base leading-relaxed">
                Sistem Pendukung Keputusan ini akan membantu kamu menentukan kegiatan pengembangan diri yang paling cocok (UKM, Lomba, atau Sertifikasi) berdasarkan kriteria minat dan kemampuan IT kamu secara objektif menggunakan metode Simple Additive Weighting (SAW).
            </p>
        </div>
        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-indigo-500/10 rounded-full blur-3xl"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <a href="{{ route('rekomendasi.form') }}" class="group p-5 bg-slate-900/50 border border-slate-800 hover:border-violet-500/50 rounded-xl transition-all duration-300 flex items-center space-x-4 shadow-lg hover:shadow-violet-500/5">
            <div class="p-3 bg-violet-500/10 text-violet-400 group-hover:bg-violet-500 group-hover:text-white rounded-lg transition-all duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-medium">Form Preferensi</p>
                <p class="text-sm font-bold text-white mt-0.5 group-hover:text-violet-400 transition-colors flex items-center gap-1">
                    Isi Minat Sekarang <span class="transform group-hover:translate-x-1 transition-transform">➔</span>
                </p>
            </div>
        </a>

        <a href="{{ route('rekomendasi.hasil') }}" class="group p-5 bg-slate-900/50 border border-slate-800 hover:border-emerald-500/50 rounded-xl transition-all duration-300 flex items-center space-x-4 shadow-lg hover:shadow-emerald-500/5">
            <div class="p-3 bg-emerald-500/10 text-emerald-400 group-hover:bg-emerald-500 group-hover:text-white rounded-lg transition-all duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h2a2 2 0 002-2zm12 0v-11a2 2 0 00-2-2h-2a2 2 0 00-2 2v11a2 2 0 002 2h2a2 2 0 002-2zm0 0V5a2 2 0 00-2-2h-2a2 2 0 00-2 2v14a2 2 0 002 2h2a2 2 0 002-2z"></path></svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-medium">Hasil Perhitungan</p>
                <p class="text-sm font-bold text-white mt-0.5 group-hover:text-emerald-400 transition-colors flex items-center gap-1">
                    Lihat Ranking SAW <span class="transform group-hover:translate-x-1 transition-transform">➔</span>
                </p>
            </div>
        </a>

        <div class="p-5 bg-slate-900/50 border border-slate-800 rounded-xl flex items-center space-x-4 shadow-lg">
            <div class="p-3 bg-amber-500/10 text-amber-400 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-medium">Total Alternatif</p>
                <p class="text-lg font-extrabold text-white mt-0.5">3 Pilihan Kegiatan</p>
            </div>
        </div>
    </div>

    <div class="bg-slate-900/40 border border-slate-800 rounded-2xl p-6 shadow-xl">
        <h3 class="text-lg font-bold text-white mb-5 flex items-center gap-2">
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Alur Penentuan Rekomendasi Kegiatan (Metode SAW)
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 relative">
            <div class="relative p-5 bg-slate-950/60 border border-slate-800/80 rounded-xl">
                <span class="absolute top-3 right-4 text-3xl font-black text-slate-800/60 select-none font-mono">01</span>
                <h4 class="text-sm font-semibold text-indigo-400 mb-1.5">Isi Bobot Kepentingan</h4>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Masuk ke menu <span class="text-slate-300 font-medium">Input Minat & Kriteria</span>, lalu tentukan seberapa penting masing-masing kriteria sesuai dengan target capaianmu.
                </p>
            </div>
            <div class="relative p-5 bg-slate-950/60 border border-slate-800/80 rounded-xl">
                <span class="absolute top-3 right-4 text-3xl font-black text-slate-800/60 select-none font-mono">02</span>
                <h4 class="text-sm font-semibold text-violet-400 mb-1.5">Normalisasi Matriks</h4>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Sistem otomatis menghitung nilai kecocokan setiap alternatif kegiatan berdasarkan sifat kriteria <span class="text-emerald-400 font-medium">Benefit</span> atau <span class="text-rose-400 font-medium">Cost</span>.
                </p>
            </div>
            <div class="relative p-5 bg-slate-950/60 border border-slate-800/80 rounded-xl">
                <span class="absolute top-3 right-4 text-3xl font-black text-slate-800/60 select-none font-mono">03</span>
                <h4 class="text-sm font-semibold text-emerald-400 mb-1.5">Hasil Ranking Akhir</h4>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Nilai preferensi total dijumlahkan untuk menghasilkan skor akhir $V_i$. Alternatif dengan skor tertinggi akan menjadi rekomendasi utama kamu.
                </p>
            </div>
        </div>
    </div>

    <div class="bg-slate-900/40 border border-slate-800 rounded-2xl p-6 shadow-xl">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 space-y-2 sm:space-y-0">
            <h3 class="text-lg font-bold text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                Matriks Acuan Kriteria Default
            </h3>
            <p class="text-xs text-slate-400">Total akumulasi bobot wajib senilai 100% (1.00)</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="p-4 bg-slate-950/40 border border-slate-800 rounded-xl flex flex-col justify-between">
                <div class="flex items-center justify-between mb-1">
                    <span class="text-xs font-bold text-indigo-400 font-mono">C1</span>
                    <span class="px-1.5 py-0.5 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-[10px] rounded font-semibold uppercase">Benefit</span>
                </div>
                <h5 class="text-xs font-bold text-white mb-3">Prestasi Academic / IPK</h5>
                <div class="w-full bg-slate-800 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-indigo-500 h-full rounded-full" style="width: 25%"></div>
                </div>
            </div>
            <div class="p-4 bg-slate-950/40 border border-slate-800 rounded-xl flex flex-col justify-between">
                <div class="flex items-center justify-between mb-1">
                    <span class="text-xs font-bold text-indigo-400 font-mono">C2</span>
                    <span class="px-1.5 py-0.5 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-[10px] rounded font-semibold uppercase">Benefit</span>
                </div>
                <h5 class="text-xs font-bold text-white mb-3">Minat Bakat Coding & Core IT</h5>
                <div class="w-full bg-slate-800 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-indigo-500 h-full rounded-full" style="width: 35%"></div>
                </div>
            </div>
            <div class="p-4 bg-slate-950/40 border border-slate-800 rounded-xl flex flex-col justify-between">
                <div class="flex items-center justify-between mb-1">
                    <span class="text-xs font-bold text-indigo-400 font-mono">C3</span>
                    <span class="px-1.5 py-0.5 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-[10px] rounded font-semibold uppercase">Benefit</span>
                </div>
                <h5 class="text-xs font-bold text-white mb-3">Ketersediaan Waktu Sisa</h5>
                <div class="w-full bg-slate-800 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-indigo-500 h-full rounded-full" style="width: 20%"></div>
                </div>
            </div>
            <div class="p-4 bg-slate-950/40 border border-slate-800 rounded-xl flex flex-col justify-between">
                <div class="flex items-center justify-between mb-1">
                    <span class="text-xs font-bold text-indigo-400 font-mono">C4</span>
                    <span class="px-1.5 py-0.5 bg-rose-500/10 text-rose-400 border border-rose-500/20 text-[10px] rounded font-semibold uppercase">Cost</span>
                </div>
                <h5 class="text-xs font-bold text-white mb-3">Biaya Pendaftaran</h5>
                <div class="w-full bg-slate-800 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-indigo-500 h-full rounded-full" style="width: 20%"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection