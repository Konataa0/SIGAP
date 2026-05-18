@extends('layouts.app')

@section('page_title', 'Dashboard Utama Mahasiswa')

@section('content')
<div class="space-y-6">
    <div class="bg-gradient-to-r from-indigo-900 to-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl relative overflow-hidden">
        <div class="absolute right-0 top-0 w-48 h-48 bg-indigo-500/10 blur-2xl rounded-full pointer-events-none"></div>
        <h3 class="text-xl font-bold text-white mb-1">Selamat Datang di SIGAP Panel, Bro! 👋</h3>
        <p class="text-sm text-slate-400 max-w-2xl">Sistem Pendukung Keputusan ini akan membantu kamu menentukan kegiatan pengembangan diri yang paling cocok (UKM, Lomba, atau Sertifikasi) berdasarkan kriteria minat dan kemampuan IT kamu.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-slate-900 border border-slate-800 p-5 rounded-xl flex items-center gap-4">
            <div class="p-3 bg-indigo-500/10 text-indigo-400 rounded-xl">
                <i data-lucide="sliders" class="w-6 h-6"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-medium block">Form Preferensi</span>
                <a href="{{ route('rekomendasi.form') }}" class="text-sm font-bold text-white hover:text-indigo-400 flex items-center gap-1 transition-all mt-0.5">
                    Isi Minat Sekarang <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>
        </div>

        <div class="bg-slate-900 border border-slate-800 p-5 rounded-xl flex items-center gap-4">
            <div class="p-3 bg-emerald-500/10 text-emerald-400 rounded-xl">
                <i data-lucide="award" class="w-6 h-6"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-medium block">Hasil Perhitungan</span>
                <a href="{{ route('rekomendasi.hasil') }}" class="text-sm font-bold text-white hover:text-emerald-400 flex items-center gap-1 transition-all mt-0.5">
                    Lihat Ranking SAW <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>
        </div>

        <div class="bg-slate-900 border border-slate-800 p-5 rounded-xl flex items-center gap-4">
            <div class="p-3 bg-amber-500/10 text-amber-400 rounded-xl">
                <i data-lucide="layers" class="w-6 h-6"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-medium block">Total Alternatif</span>
                <span class="text-sm font-bold text-white block mt-0.5">3 Pilihan Kegiatan</span>
            </div>
        </div>
    </div>
</div>
@endsection