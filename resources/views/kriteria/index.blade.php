@extends('layouts.app')

@section('page_title', 'Manajemen Bobot Kriteria (SAW)')

@section('content')
<div class="space-y-6">
    <div>
        <h3 class="text-xl font-extrabold text-white mb-1">Pengaturan Matriks Kriteria</h3>
        <p class="text-sm text-slate-400">Tentukan sifat kriteria (*Benefit* atau *Cost*) beserta bobot dasarnya untuk proses normalisasi perhitungan.</p>
    </div>

    <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-950/60 border-b border-slate-800 text-xs font-bold text-slate-400 uppercase tracking-wider">
                        <th class="p-4">Kode</th>
                        <th class="p-4">Nama Kriteria</th>
                        <th class="p-4">Jenis / Sifat</th>
                        <th class="p-4">Bobot Default</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 text-sm text-slate-300">
                    <tr>
                        <td class="p-4 font-mono text-indigo-400 font-bold">C1</td>
                        <td class="p-4 text-white font-medium">Prestasi Akademik / IPK</td>
                        <td class="p-4"><span class="px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-400 text-xs font-bold uppercase">Benefit</span></td>
                        <td class="p-4 font-semibold text-slate-400">25% (0.25)</td>
                    </tr>
                    <tr>
                        <td class="p-4 font-mono text-indigo-400 font-bold">C2</td>
                        <td class="p-4 text-white font-medium">Minat Bakat Coding & Core IT</td>
                        <td class="p-4"><span class="px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-400 text-xs font-bold uppercase">Benefit</span></td>
                        <td class="p-4 font-semibold text-slate-400">35% (0.35)</td>
                    </tr>
                    <tr>
                        <td class="p-4 font-mono text-indigo-400 font-bold">C3</td>
                        <td class="p-4 text-white font-medium">Ketersediaan Waktu Sisa</td>
                        <td class="p-4"><span class="px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-400 text-xs font-bold uppercase">Benefit</span></td>
                        <td class="p-4 font-semibold text-slate-400">20% (0.20)</td>
                    </tr>
                    <tr>
                        <td class="p-4 font-mono text-indigo-400 font-bold">C4</td>
                        <td class="p-4 text-white font-medium">Biaya Pendaftaran Kegiatan</td>
                        <td class="p-4"><span class="px-2 py-0.5 rounded bg-rose-500/10 text-rose-400 text-xs font-bold uppercase">Cost</span></td>
                        <td class="p-4 font-semibold text-slate-400">20% (0.20)</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection