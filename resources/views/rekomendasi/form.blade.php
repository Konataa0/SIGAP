@extends('layouts.app')

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
    </div>
</div>
@endsection