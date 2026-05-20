@extends('layouts.app')

@section('page_title', 'Form Preferensi Mahasiswa')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div>
        <h3 class="text-xl font-extrabold text-white mb-1">Input Minat & Target Karir IT</h3>
        <p class="text-sm text-slate-400">
            Geser slider sesuai tingkat kepentingan tiap kriteria bagimu.
            Hasil perhitungan SAW akan menyesuaikan rekomendasi berdasarkan preferensimu.
        </p>
    </div>

    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 lg:p-8 shadow-xl">
        <form action="{{ route('rekomendasi.proses') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($kriteria as $k)
                <div class="p-5 bg-slate-950 border border-slate-800/80 rounded-xl space-y-4 hover:border-indigo-500/30 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-xs font-bold text-indigo-400 uppercase tracking-wider">{{ $k->kode }}</span>
                            <h3 class="text-sm font-bold text-white mt-0.5">{{ $k->nama }}</h3>
                        </div>
                        <span class="px-2 py-0.5 rounded-md text-[10px] font-bold uppercase
                            {{ $k->jenis === 'benefit'
                                ? 'bg-emerald-500/10 border border-emerald-500/20 text-emerald-400'
                                : 'bg-amber-500/10 border border-amber-500/20 text-amber-400' }}">
                            {{ $k->jenis }}
                        </span>
                    </div>

                    @if($k->keterangan)
                        <p class="text-xs text-slate-500 leading-relaxed">{{ $k->keterangan }}</p>
                    @endif

                    {{-- Slider preferensi --}}
                    <div class="space-y-2">
                        <input type="range"
                               name="preferensi[{{ $k->kode }}]"
                               min="1" max="5" value="3"
                               class="w-full accent-indigo-500 h-1.5 bg-slate-800 rounded-lg appearance-none cursor-pointer"
                               oninput="this.nextElementSibling.querySelector('span').textContent = this.value">
                        <div class="flex justify-between text-[10px] text-slate-500 font-semibold px-1">
                            <span>1 (Tidak Penting)</span>
                            <span class="text-indigo-400 font-black">Nilai: <span>3</span></span>
                            <span>5 (Sangat Penting)</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="p-4 bg-indigo-600/5 border border-indigo-500/20 rounded-xl flex items-start gap-3">
                <i data-lucide="info" class="w-5 h-5 text-indigo-400 shrink-0 mt-0.5"></i>
                <p class="text-xs text-slate-400 leading-relaxed">
                    <strong class="text-slate-200 block mb-0.5">Cara Kerja Algoritma SAW</strong>
                    Preferensimu digunakan untuk <span class="text-indigo-400 font-semibold">menggeser bobot kriteria</span>,
                    bukan mengubah nilai kegiatan. Nilai kegiatan adalah data objektif yang sudah ditetapkan admin.
                    Rumus: <span class="text-indigo-300 font-mono">V_i = Σ (W_j × R_ij)</span>
                    di mana W_j = bobot dinamis dan R_ij = nilai normalisasi kegiatan.
                </p>
            </div>

            <div class="flex justify-end pt-4 border-t border-slate-800">
                <button type="submit"
                        class="flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-bold text-sm px-6 py-3 rounded-xl shadow-lg shadow-indigo-500/10 transition-all">
                    <i data-lucide="cpu" class="w-4 h-4"></i> Proses & Hitung Rekomendasi SAW
                </button>
            </div>
        </form>
    </div>

</div>
@endsection