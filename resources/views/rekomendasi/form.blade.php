@extends('layouts.app')

<<<<<<< HEAD
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
=======
@section('page_title', 'Form Preferensi Mahasiswa')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h3 class="text-xl font-extrabold text-white mb-2">Input Minat & Target Karir IT</h3>
        <p class="text-sm text-slate-400">Silakan tentukan bobot prioritas dan kriteria sesuai dengan kondisi dan tujuan pengembangan diri kamu semester ini agar hasil perhitungan SAW akurat.</p>
    </div>

    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 lg:p-8 shadow-xl">
        <form action="{{ route('rekomendasi.proses') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($kriteria as $k)
                <div class="p-4 bg-slate-950 border border-slate-800/80 rounded-xl space-y-3 hover:border-indigo-500/30 transition-all">
                    <div class="flex items-center justify-between">
                        <label class="block text-sm font-bold text-white tracking-wide">
                            {{ $k->nama_kriteria }} <span class="text-indigo-400 text-xs ml-1">({{ $k->kode }})</span>
                        </label>
                        <span class="text-[10px] bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 px-2 py-0.5 rounded-md font-semibold tracking-wide uppercase">{{ $k->jenis }}</span>
                    </div>
                    
                    <p class="text-xs text-slate-500 leading-relaxed">Pilih tingkat kepentingan kriteria ini terhadap target capaian semestermu.</p>
                    
                    <select name="kriteria[{{ $k->id }}]" class="w-full bg-slate-900 border border-slate-800 rounded-xl px-3 py-2.5 text-sm text-slate-300 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all cursor-pointer">
                        <option value="1">1 - Sangat Rendah (Tidak Terlalu Penting)</option>
                        <option value="2">2 - Rendah</option>
                        <option value="3" selected>3 - Cukup (Standar)</option>
                        <option value="4">4 - Tinggi (Prioritas)</option>
                        <option value="5">5 - Sangat Tinggi (Sangat Wajib Diikuti)</option>
                    </select>
                </div>
                @endforeach
            </div>

            <div class="p-4 bg-indigo-600/5 border border-indigo-500/20 rounded-xl flex items-start gap-3 mt-6">
                <i data-lucide="info" class="w-5 h-5 text-indigo-400 shrink-0 mt-0.5"></i>
                <p class="text-xs text-slate-400 leading-relaxed">
                    <strong class="text-slate-200 block mb-0.5">Bagaimana Sistem Berjalan?</strong>
                    Inputan di atas akan dihitung menggunakan metode <span class="text-indigo-400 font-semibold">Simple Additive Weighting (SAW)</span> dengan menormalisasi matriks keputusan terhadap alternatif kegiatan (UKM, Lomba, Sertifikasi) yang terdaftar di sistem.
                </p>
            </div>

            <div class="flex justify-end pt-4 border-t border-slate-800">
                <button type="submit" class="flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-semibold text-sm px-6 py-3 rounded-xl shadow-lg shadow-indigo-500/10 transition-all cursor-pointer">
                    <i data-lucide="cpu" class="w-4 h-4"></i> Proses & Hitung Rekomendasi
                </button>
            </div>
        </form>
>>>>>>> 409f46d2c0a2d7f621750e1b60bf38135fd6931e
    </div>
</div>
@endsection