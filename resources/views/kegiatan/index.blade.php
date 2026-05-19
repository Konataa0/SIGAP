@extends('layouts.app')

@section('page_title', 'Kelola Alternatif Kegiatan')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h3 class="text-xl font-extrabold text-white mb-1">Daftar Alternatif Pengembangan Diri</h3>
            <p class="text-sm text-slate-400">Data ini digunakan sebagai objek alternatif yang akan dihitung rangkingnya oleh sistem SAW.</p>
        </div>
        <button class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs px-4 py-2.5 rounded-xl shadow-lg shadow-indigo-500/10 transition-all cursor-pointer">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Kegiatan
        </button>
    </div>

    <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-950/60 border-b border-slate-800 text-xs font-bold text-slate-400 uppercase tracking-wider">
                        <th class="p-4 w-16 text-center">No</th>
                        <th class="p-4">Nama Kegiatan / Alternatif</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 text-sm text-slate-300">
                    <tr class="hover:bg-slate-800/30 transition-all">
                        <td class="p-4 text-center font-semibold text-slate-500">1</td>
                        <td class="p-4 font-bold text-white">Sertifikasi Cisco CyberOps Associate</td>
                        <td class="p-4">
                            <span class="px-2.5 py-1 rounded-lg bg-purple-500/10 text-purple-400 border border-purple-500/20 text-xs font-medium">Sertifikasi</span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center justify-center gap-2">
                                <button class="p-2 text-slate-400 hover:text-indigo-400 hover:bg-indigo-500/10 rounded-lg transition-all" title="Edit"><i data-lucide="edit-3" class="w-4 h-4"></i></button>
                                <button class="p-2 text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 rounded-lg transition-all" title="Hapus"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-800/30 transition-all">
                        <td class="p-4 text-center font-semibold text-slate-500">2</td>
                        <td class="p-4 font-bold text-white">UKM Programming & Mobile Apps Developer</td>
                        <td class="p-4">
                            <span class="px-2.5 py-1 rounded-lg bg-blue-500/10 text-blue-400 border border-blue-500/20 text-xs font-medium">UKM Kampus</span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center justify-center gap-2">
                                <button class="p-2 text-slate-400 hover:text-indigo-400 hover:bg-indigo-500/10 rounded-lg transition-all" title="Edit"><i data-lucide="edit-3" class="w-4 h-4"></i></button>
                                <button class="p-2 text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 rounded-lg transition-all" title="Hapus"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-800/30 transition-all">
                        <td class="p-4 text-center font-semibold text-slate-500">3</td>
                        <td class="p-4 font-bold text-white">Lomba Pagelaran Mahasiswa Nasional Bidang TIK (GEMASTIK)</td>
                        <td class="p-4">
                            <span class="px-2.5 py-1 rounded-lg bg-amber-500/10 text-amber-400 border border-amber-500/20 text-xs font-medium">Kompetisi / Lomba</span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center justify-center gap-2">
                                <button class="p-2 text-slate-400 hover:text-indigo-400 hover:bg-indigo-500/10 rounded-lg transition-all" title="Edit"><i data-lucide="edit-3" class="w-4 h-4"></i></button>
                                <button class="p-2 text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 rounded-lg transition-all" title="Hapus"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection