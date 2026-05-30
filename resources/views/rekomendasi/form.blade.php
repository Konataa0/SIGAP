@extends('layouts.app')

@section('page_title', 'Form Preferensi Mahasiswa')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div>
        <h3 class="text-xl font-extrabold text-white mb-1">Input Preferensi Mahasiswa</h3>
        <p class="text-sm text-slate-400">Isi minat teknis, target karir, waktu luang, dan tujuan agar SAW bisa memberi ranking kegiatan yang lebih personal.</p>
    </div>

    <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6 md:p-8 shadow-xl">
        <form action="{{ route('rekomendasi.proses') }}" method="POST" class="space-y-8">
            @csrf

            @php
                $selectedMinat = old('minat_teknis', []);
                $selectedKarir = old('target_karir');
                $selectedWaktu = old('waktu_luang');
                $selectedTujuan = old('tujuan');
            @endphp

            <section class="space-y-4">
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-cyan-400">Minat Teknis</h4>
                    <p class="mt-1 text-xs text-slate-400">Pilih satu atau lebih bidang yang paling kamu minati.</p>
                </div>
                <div class="grid gap-3 md:grid-cols-2 xl:grid-cols-4">
                    @foreach($minatTeknis as $item)
                        <label class="flex items-center gap-3 rounded-2xl border border-slate-800 bg-slate-950 px-4 py-3 text-sm text-slate-200">
                            <input type="checkbox" name="minat_teknis[]" value="{{ $item }}" @checked(in_array($item, $selectedMinat)) class="h-4 w-4 rounded border-slate-600 bg-slate-900 text-cyan-500 focus:ring-cyan-500">
                            <span>{{ $item }}</span>
                        </label>
                    @endforeach
                </div>
            </section>

            <section class="space-y-4">
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-cyan-400">Target Karir</h4>
                    <p class="mt-1 text-xs text-slate-400">Pilih satu target karir utama.</p>
                </div>
                <div class="grid gap-3 md:grid-cols-2 xl:grid-cols-3">
                    @foreach($targetKarir as $item)
                        <label class="flex items-center gap-3 rounded-2xl border border-slate-800 bg-slate-950 px-4 py-3 text-sm text-slate-200">
                            <input type="radio" name="target_karir" value="{{ $item }}" @checked($selectedKarir === $item) class="h-4 w-4 border-slate-600 bg-slate-900 text-cyan-500 focus:ring-cyan-500">
                            <span>{{ $item }}</span>
                        </label>
                    @endforeach
                </div>
            </section>

            <section class="space-y-4">
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-cyan-400">Waktu Luang</h4>
                    <p class="mt-1 text-xs text-slate-400">Pilih rentang waktu luang per minggu.</p>
                </div>
                <div class="grid gap-3 md:grid-cols-3">
                    @foreach($waktuLuang as $item)
                        <label class="flex items-center gap-3 rounded-2xl border border-slate-800 bg-slate-950 px-4 py-3 text-sm text-slate-200">
                            <input type="radio" name="waktu_luang" value="{{ $item }}" @checked($selectedWaktu === $item) class="h-4 w-4 border-slate-600 bg-slate-900 text-cyan-500 focus:ring-cyan-500">
                            <span>{{ $item }}</span>
                        </label>
                    @endforeach
                </div>
            </section>

            <section class="space-y-4">
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-cyan-400">Tujuan</h4>
                    <p class="mt-1 text-xs text-slate-400">Pilih tujuan utama mengikuti kegiatan.</p>
                </div>
                <div class="grid gap-3 md:grid-cols-2 xl:grid-cols-4">
                    @foreach($tujuan as $item)
                        <label class="flex items-center gap-3 rounded-2xl border border-slate-800 bg-slate-950 px-4 py-3 text-sm text-slate-200">
                            <input type="radio" name="tujuan" value="{{ $item }}" @checked($selectedTujuan === $item) class="h-4 w-4 border-slate-600 bg-slate-900 text-cyan-500 focus:ring-cyan-500">
                            <span>{{ $item }}</span>
                        </label>
                    @endforeach
                </div>
            </section>

            <div class="rounded-2xl border border-cyan-500/20 bg-cyan-500/5 p-5 text-sm text-slate-300">
                Preferensi ini akan diterjemahkan ke bobot kriteria SAW dan disimpan sebagai sesi rekomendasi baru.
            </div>

            <div class="flex justify-end">
                <button type="submit" class="rounded-xl bg-cyan-500 px-6 py-3 text-sm font-bold text-slate-950">Proses Rekomendasi</button>
            </div>
        </form>
    </div>
</div>
@endsection
