@extends('layouts.app')

@section('page_title', 'Tambah Kegiatan')

@section('content')
<div class="max-w-3xl space-y-6">

    <div class="flex items-center gap-4">
        <a href="{{ route('admin.kegiatan.index') }}"
           class="p-2 text-slate-400 hover:text-white hover:bg-slate-800 rounded-lg transition-all">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
        </a>
        <div>
            <h3 class="text-xl font-extrabold text-white">Tambah Kegiatan Baru</h3>
            <p class="text-sm text-slate-400">Isi data kegiatan dan nilai per kriteria SAW (skala 1–5)</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.kegiatan.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Data utama kegiatan --}}
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 space-y-5">
            <h4 class="text-sm font-bold text-slate-300 uppercase tracking-wider pb-2 border-b border-slate-800">
                Informasi Kegiatan
            </h4>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- Nama --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">
                        Nama Kegiatan <span class="text-rose-400">*</span>
                    </label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                           placeholder="Contoh: UKM Robotika"
                           class="w-full bg-slate-950 border border-slate-800 focus:border-indigo-500 rounded-xl px-4 py-2.5 text-sm text-white outline-none transition-all">
                    @error('nama')
                        <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jenis --}}
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">
                        Jenis <span class="text-rose-400">*</span>
                    </label>
                    <select name="jenis"
                            class="w-full bg-slate-950 border border-slate-800 focus:border-indigo-500 rounded-xl px-4 py-2.5 text-sm text-white outline-none transition-all">
                        <option value="">-- Pilih Jenis --</option>
                        <option value="ukm"         {{ old('jenis') === 'ukm'         ? 'selected' : '' }}>UKM</option>
                        <option value="lomba"       {{ old('jenis') === 'lomba'       ? 'selected' : '' }}>Lomba / Kompetisi</option>
                        <option value="sertifikasi" {{ old('jenis') === 'sertifikasi' ? 'selected' : '' }}>Sertifikasi</option>
                    </select>
                    @error('jenis')
                        <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Penyelenggara --}}
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">Penyelenggara</label>
                    <input type="text" name="penyelenggara" value="{{ old('penyelenggara') }}"
                           placeholder="Contoh: BEM Fakultas"
                           class="w-full bg-slate-950 border border-slate-800 focus:border-indigo-500 rounded-xl px-4 py-2.5 text-sm text-white outline-none transition-all">
                </div>

                {{-- Deskripsi --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                              placeholder="Deskripsi singkat kegiatan..."
                              class="w-full bg-slate-950 border border-slate-800 focus:border-indigo-500 rounded-xl px-4 py-2.5 text-sm text-white outline-none transition-all resize-none">{{ old('deskripsi') }}</textarea>
                </div>
            </div>
        </div>

        {{-- Nilai per Kriteria SAW --}}
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 space-y-5">
            <div>
                <h4 class="text-sm font-bold text-slate-300 uppercase tracking-wider pb-2 border-b border-slate-800">
                    Nilai Kriteria SAW
                </h4>
                <p class="text-xs text-slate-500 mt-2">
                    Isi nilai kegiatan per kriteria dengan skala <span class="text-white font-bold">1 (sangat rendah) – 5 (sangat tinggi)</span>.
                    Nilai ini menjadi matriks keputusan dalam algoritma SAW.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($kriterias as $k)
                <div class="p-4 bg-slate-950 border border-slate-800 rounded-xl space-y-2">
                    <div class="flex items-center justify-between">
                        <label class="text-sm font-bold text-white">
                            {{ $k->kode }} — {{ $k->nama }}
                        </label>
                        <span class="text-[10px] px-2 py-0.5 rounded font-bold uppercase
                            {{ $k->jenis === 'benefit' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-amber-500/10 text-amber-400 border border-amber-500/20' }}">
                            {{ $k->jenis }}
                        </span>
                    </div>
                    @if($k->keterangan)
                        <p class="text-xs text-slate-500">{{ $k->keterangan }}</p>
                    @endif
                    <select name="nilai[{{ $k->id }}]"
                            class="w-full bg-slate-900 border border-slate-700 focus:border-indigo-500 rounded-lg px-3 py-2 text-sm text-white outline-none transition-all">
                        <option value="">-- Pilih Nilai --</option>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old("nilai.{$k->id}") == $i ? 'selected' : '' }}>
                                {{ $i }} — {{ ['','Sangat Rendah','Rendah','Cukup','Tinggi','Sangat Tinggi'][$i] }}
                            </option>
                        @endfor
                    </select>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Submit --}}
        <div class="flex items-center gap-3 justify-end">
            <a href="{{ route('admin.kegiatan.index') }}"
               class="px-5 py-2.5 text-slate-400 hover:text-white text-sm font-semibold transition-all">
                Batal
            </a>
            <button type="submit"
                    class="flex items-center gap-2 px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-500/10 transition-all">
                <i data-lucide="save" class="w-4 h-4"></i> Simpan Kegiatan
            </button>
        </div>
    </form>

</div>
@endsection