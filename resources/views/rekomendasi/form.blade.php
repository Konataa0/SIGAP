@extends('layouts.app')

@section('title', 'SIGAP - Input Preferensi Kriteria')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-white tracking-wide">Form Preferensi Mahasiswa</h1>
        <p class="text-slate-400 text-sm mt-1">Silakan tentukan bobot prioritas kriteria sesuai dengan kondisi dan target capaian kuliahmu semester ini agar hasil perhitungan SAW akurat.</p>
    </div>

    <form action="#" method="POST" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="p-5 bg-slate-900/40 border border-slate-800 rounded-2xl flex flex-col justify-between space-y-4">
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <h3 class="text-sm font-bold text-white">Prestasi Akademik / IPK <span class="text-indigo-400 font-mono text-xs">(C1)</span></h3>
                        <span class="px-1.5 py-0.5 bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 text-[10px] rounded font-semibold uppercase">Benefit</span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">Pilih tingkat kepentingan kriteria ini terhadap target capaian semestermu.</p>
                </div>
                <select name="c1" class="w-full bg-slate-950 border border-slate-800 text-slate-300 text-sm rounded-xl p-3 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all outline-none cursor-pointer">
                    <option value="1">1 - Sangat Rendah</option>
                    <option value="2" selected>2 - Rendah</option>
                    <option value="3">3 - Cukup (Standar)</option>
                    <option value="4">4 - Tinggi</option>
                    <option value="5">5 - Sangat Tinggi</option>
                </select>
            </div>

            <div class="p-5 bg-slate-900/40 border border-slate-800 rounded-2xl flex flex-col justify-between space-y-4">
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <h3 class="text-sm font-bold text-white">Minat Bakat Coding & Core IT <span class="text-indigo-400 font-mono text-xs">(C2)</span></h3>
                        <span class="px-1.5 py-0.5 bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 text-[10px] rounded font-semibold uppercase">Benefit</span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">Pilih tingkat kepentingan kriteria ini terhadap target capaian semestermu.</p>
                </div>
                <select name="c2" class="w-full bg-slate-950 border border-slate-800 text-slate-300 text-sm rounded-xl p-3 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all outline-none cursor-pointer">
                    <option value="1">1 - Sangat Rendah</option>
                    <option value="2" selected>2 - Rendah</option>
                    <option value="3">3 - Cukup (Standar)</option>
                    <option value="4">4 - Tinggi</option>
                    <option value="5">5 - Sangat Tinggi</option>
                </select>
            </div>

            <div class="p-5 bg-slate-900/40 border border-slate-800 rounded-2xl flex flex-col justify-between space-y-4">
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <h3 class="text-sm font-bold text-white">Ketersediaan Waktu Sisa <span class="text-indigo-400 font-mono text-xs">(C3)</span></h3>
                        <span class="px-1.5 py-0.5 bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 text-[10px] rounded font-semibold uppercase">Benefit</span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">Pilih tingkat kepentingan kriteria ini terhadap target capaian semestermu.</p>
                </div>
                <select name="c3" class="w-full bg-slate-950 border border-slate-800 text-slate-300 text-sm rounded-xl p-3 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all outline-none cursor-pointer">
                    <option value="1">1 - Sangat Rendah</option>
                    <option value="2">2 - Rendah</option>
                    <option value="3" selected>3 - Cukup (Standar)</option>
                    <option value="4">4 - Tinggi</option>
                    <option value="5">5 - Sangat Tinggi</option>
                </select>
            </div>

            <div class="p-5 bg-slate-900/40 border border-slate-800 rounded-2xl flex flex-col justify-between space-y-4">
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <h3 class="text-sm font-bold text-white">Biaya Pendaftaran Kegiatan <span class="text-rose-400 font-mono text-xs">(C4)</span></h3>
                        <span class="px-1.5 py-0.5 bg-rose-500/10 text-rose-400 border border-rose-500/20 text-[10px] rounded font-semibold uppercase">Cost</span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">Pilih tingkat kepentingan kriteria ini terhadap target capaian semestermu.</p>
                </div>
                <select name="c4" class="w-full bg-slate-950 border border-slate-800 text-slate-300 text-sm rounded-xl p-3 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all outline-none cursor-pointer">
                    <option value="1">1 - Sangat Rendah (Gratis)</option>
                    <option value="2" selected>2 - Rendah (Murah)</option>
                    <option value="3">3 - Cukup (Sedang)</option>
                    <option value="4">4 - Tinggi (Mahal)</option>
                    <option value="5">5 - Sangat Tinggi (Sangat Mahal)</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end pt-2">
            <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-medium text-sm rounded-xl transition-all duration-200 shadow-lg shadow-indigo-600/20 flex items-center gap-2 group">
                <svg class="w-4 h-4 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                Hitung Rekomendasi Sekarang
            </button>
        </div>
    </form>

    <div class="bg-slate-900/30 border border-slate-800 rounded-2xl p-6 space-y-4 shadow-xl">
        <div class="flex items-center gap-2.5">
            <div class="p-2 bg-indigo-500/10 text-indigo-400 rounded-lg">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-white">Panduan Pembobotan Nilai (Skala Likert)</h3>
                <p class="text-xs text-slate-400">Gunakan acuan konversi parameter di bawah ini untuk menentukan tingkat prioritas kriteria:</p>
            </div>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-5 gap-3 text-center">
            <div class="p-3.5 bg-slate-950/50 border border-slate-800/80 rounded-xl flex flex-col justify-between">
                <span class="text-xs font-bold text-indigo-400 font-mono">Skor 1</span>
                <span class="text-[11px] text-slate-400 font-medium mt-1">Sangat Rendah / Sangat Murah</span>
            </div>
            <div class="p-3.5 bg-slate-950/50 border border-slate-800/80 rounded-xl flex flex-col justify-between">
                <span class="text-xs font-bold text-indigo-400 font-mono">Skor 2</span>
                <span class="text-[11px] text-slate-400 font-medium mt-1">Rendah / Terjangkau</span>
            </div>
            <div class="p-3.5 bg-slate-950/50 border border-slate-800/80 rounded-xl flex flex-col justify-between">
                <span class="text-xs font-bold text-indigo-400 font-mono">Skor 3</span>
                <span class="text-[11px] text-slate-400 font-medium mt-1">Cukup / Standar Netral</span>
            </div>
            <div class="p-3.5 bg-slate-950/50 border border-slate-800/80 rounded-xl flex flex-col justify-between">
                <span class="text-xs font-bold text-indigo-400 font-mono">Skor 4</span>
                <span class="text-[11px] text-slate-400 font-medium mt-1">Tinggi / Berbobot</span>
            </div>
            <div class="p-3.5 bg-slate-950/50 border border-slate-800/80 rounded-xl flex flex-col justify-between">
                <span class="text-xs font-bold text-indigo-400 font-mono">Skor 5</span>
                <span class="text-[11px] text-slate-400 font-medium mt-1">Sangat Tinggi / Utama</span>
            </div>
        </div>
    </div>
</div>
@endsection