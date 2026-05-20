@extends('layouts.app')

@section('title', 'SIGAP - Admin Dashboard')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-2 md:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-wide">Panel Utama Manajemen Admin</h1>
            <p class="text-slate-400 text-sm mt-0.5">Pantau parameter pembobotan matriks keputusan dan opsi alternatif bimbingan mahasiswa.</p>
        </div>
        <span class="px-3 py-1 bg-rose-500/10 text-rose-400 border border-rose-500/20 text-xs rounded-full font-semibold uppercase tracking-wider">
            Sistem Role: Administrator
        </span>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="p-4 bg-gradient-to-br from-slate-900 via-slate-900 to-indigo-950/30 border border-slate-800 rounded-xl shadow-md">
            <div class="text-[11px] font-bold text-indigo-400 uppercase tracking-wider">Total Kriteria SAW</div>
            <div class="text-2xl font-black text-white mt-1">4 Variabel</div>
            <p class="text-[10px] text-slate-500 mt-0.5">C1 s/d C4 (Fixed System)</p>
        </div>
        <div class="p-4 bg-gradient-to-br from-slate-900 via-slate-900 to-violet-950/30 border border-slate-800 rounded-xl shadow-md">
            <div class="text-[11px] font-bold text-violet-400 uppercase tracking-wider">Opsi Alternatif</div>
            <div class="text-2xl font-black text-white mt-1">3 Kegiatan</div>
            <p class="text-[10px] text-slate-500 mt-0.5">Sertifikasi, Lomba, UKM</p>
        </div>
        <div class="p-4 bg-gradient-to-br from-slate-900 via-slate-900 to-emerald-950/30 border border-slate-800 rounded-xl shadow-md">
            <div class="text-[11px] font-bold text-emerald-400 uppercase tracking-wider">Status Normalisasi</div>
            <div class="text-2xl font-black text-white mt-1">100% Valid</div>
            <p class="text-[10px] text-slate-500 mt-0.5">Matriks pembobotan sinkron</p>
        </div>
        <div class="p-4 bg-gradient-to-br from-slate-900 via-slate-900 to-amber-950/30 border border-slate-800 rounded-xl shadow-md">
            <div class="text-[11px] font-bold text-amber-400 uppercase tracking-wider">Akses Multi-User</div>
            <div class="text-2xl font-black text-white mt-1">2 Tingkat</div>
            <p class="text-[10px] text-slate-500 mt-0.5">Admin & Mahasiswa Aktif</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-slate-900/40 border border-slate-800 rounded-2xl p-6 shadow-xl">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-bold text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        Panduan Kontrol Parameter Data SPK
                    </h3>
                </div>
                <div class="text-sm text-slate-400 space-y-3 leading-relaxed">
                    <p>Sebagai administrator, kamu bertanggung jawab menjaga relevansi data kriteria yang menjadi basis hitungan algoritma Simple Additive Weighting (SAW). Pastikan untuk:</p>
                    <ul class="list-disc list-inside space-y-1.5 text-xs text-slate-300 pl-1">
                        <li>Memantau menu <span class="text-indigo-400 font-medium">Kriteria</span> jika ada penyesuaian jenis atribut (Benefit/Cost).</li>
                        <li>Memastikan bobot kepentingan default tetap berakumulasi total nilai <span class="text-emerald-400 font-medium">1.00 (100%)</span>.</li>
                        <li>Mengupdate deskripsi opsi <span class="text-indigo-400 font-medium">Kegiatan</span> secara berkala jika ada alternatif bimbingan baru dari jurusan.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="bg-slate-900/40 border border-slate-800 rounded-2xl p-6 shadow-xl flex flex-col justify-between">
            <div>
                <h3 class="text-sm font-bold text-white mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Riwayat Log Aktivitas Engine
                </h3>
                <div class="space-y-3">
                    <div class="flex items-start gap-2.5 pb-2.5 border-b border-slate-800/60">
                        <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></div>
                        <div>
                            <p class="text-xs text-slate-300 font-medium">Seeding database berhasil dijalankan</p>
                            <span class="text-[10px] text-slate-500">Baru saja • System</span>
                        </div>
                    </div>
                    <div class="flex items-start gap-2.5 pb-2.5 border-b border-slate-800/60">
                        <div class="w-1.5 h-1.5 rounded-full bg-indigo-500 mt-1.5 shrink-0"></div>
                        <div>
                            <p class="text-xs text-slate-300 font-medium">Matriks nilai preferensi $V_i$ ter-reset otomatis</p>
                            <span class="text-[10px] text-slate-500">10 menit lalu • Engine SAW</span>
                        </div>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <div class="w-1.5 h-1.5 rounded-full bg-slate-600 mt-1.5 shrink-0"></div>
                        <div>
                            <p class="text-xs text-slate-400">Konfigurasi Tailwind CSS di-render ulang</p>
                            <span class="text-[10px] text-slate-500">1 jam lalu • Vite Bundler</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-4 border-t border-slate-800/60 mt-4 text-center">
                <span class="text-[11px] text-indigo-400 font-medium">Sistem Berjalan Normal & Aman</span>
            </div>
        </div>
    </div>
</div>
@endsection