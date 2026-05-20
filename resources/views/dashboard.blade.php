<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-950 text-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGAP - Dashboard Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full font-sans antialiased bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-indigo-950/40 via-slate-950 to-slate-950">

    <div class="flex min-h-screen">
        <aside class="w-64 border-r border-slate-900 bg-slate-950/80 backdrop-blur-xl p-6 hidden md:flex flex-col justify-between">
            <div class="space-y-8">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-600 text-white font-black text-sm shadow-md">SG</div>
                    <div>
                        <span class="text-base font-bold text-white tracking-wide block leading-none">SIGAP Panel</span>
                        <span class="text-[9px] text-indigo-400 font-medium tracking-wider uppercase">Mahasiswa IT</span>
                    </div>
                </div>
                
                <nav class="space-y-1">
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-white bg-indigo-600/10 border border-indigo-500/20 rounded-xl text-sm font-semibold">
                        Dashboard
                    </a>
                    <a href="{{ url('/rekomendasi/form') }}" class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-white rounded-xl hover:bg-slate-900/50 transition-all text-sm font-medium">
                        Input Minat & Kriteria
                    </a>
                </nav>
            </div>

            <div class="space-y-3">
                <div class="p-4 bg-slate-900/40 border border-slate-900 rounded-xl text-xs">
                    <span class="text-slate-400 block font-bold">Logged In User</span>
                    <span class="text-indigo-400 font-medium truncate block">Mahasiswa</span>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="block">
                    @csrf
                    <button type="submit" class="flex items-center justify-center w-full gap-2 px-4 py-2.5 text-xs font-bold text-rose-400 hover:text-rose-300 bg-rose-500/5 hover:bg-rose-500/10 border border-rose-500/10 hover:border-rose-500/20 rounded-xl transition-all duration-200 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                        </svg>
                        <span>Keluar Aplikasi</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 p-6 md:p-10 overflow-y-auto space-y-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-900 pb-5">
                <div>
                    <h1 class="text-xl font-bold text-white">Dashboard Utama Mahasiswa</h1>
                    <p class="text-xs text-slate-400 mt-0.5">Sistem Pendukung Keputusan Pemilihan Kegiatan Kampus.</p>
                </div>
                <div class="px-3 py-1.5 rounded-lg bg-slate-900 border border-slate-800 text-[11px] font-semibold text-slate-300">
                    Semester Berjalan: Gasal 2026
                </div>
            </div>

            <div class="p-6 bg-gradient-to-r from-indigo-900/40 via-purple-950/20 to-slate-950 border border-indigo-950 rounded-2xl">
                <h2 class="text-lg font-bold text-white flex items-center gap-2">
                    Selamat Datang di SIGAP Panel, Bro! 👋
                </h2>
                <p class="text-xs text-slate-400 mt-1 max-w-3xl leading-relaxed">
                    Sistem Pendukung Keputusan ini membantu kamu menentukan alternatif kegiatan pengembangan diri paling optimal (Sertifikasi, Kompetensi, Lomba Nasional, atau UKM) berdasarkan normalisasi matriks preferensi minatmu.
                </p>
            </div>

            <div class="space-y-4">
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                    Daftar Alternatif Kegiatan Kampus Tersedia (Dataset)
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="p-4 bg-slate-900/20 border border-slate-900 rounded-xl flex items-center gap-3">
                        <div class="h-9 w-9 rounded-lg bg-indigo-600/10 text-indigo-400 flex items-center justify-center text-sm font-bold">A1</div>
                        <div>
                            <span class="text-xs font-bold text-white block">Sertifikasi BNSP / Cisco</span>
                            <span class="text-[10px] text-slate-500 font-medium">Jenis: Kompetensi Keahlian</span>
                        </div>
                    </div>
                    <div class="p-4 bg-slate-900/20 border border-slate-900 rounded-xl flex items-center gap-3">
                        <div class="h-9 w-9 rounded-lg bg-violet-600/10 text-violet-400 flex items-center justify-center text-sm font-bold">A2</div>
                        <div>
                            <span class="text-xs font-bold text-white block">Lomba Nasional (KMIPN/PIMNAS)</span>
                            <span class="text-[10px] text-slate-500 font-medium">Jenis: Kompetensi Lomba</span>
                        </div>
                    </div>
                    <div class="p-4 bg-slate-900/20 border border-slate-900 rounded-xl flex items-center gap-3">
                        <div class="h-9 w-9 rounded-lg bg-emerald-600/10 text-emerald-400 flex items-center justify-center text-sm font-bold">A3</div>
                        <div>
                            <span class="text-xs font-bold text-white block">Unit Kegiatan Mahasiswa (UKM)</span>
                            <span class="text-[10px] text-slate-500 font-medium">Jenis: Organisasi Kampus</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-slate-950 border border-slate-900 rounded-2xl overflow-hidden">
                <div class="p-5 border-b border-slate-900 bg-slate-900/20 flex items-center justify-between">
                    <div>
                        <h4 class="text-xs font-bold text-white uppercase tracking-wider">Riwayat Penghitungan Terakhir</h4>
                        <p class="text-[11px] text-slate-500 mt-0.5">Daftar rekomendasi keputusan yang tersimpan di sistem.</p>
                    </div>
                    <a href="{{ url('/rekomendasi/form') }}" class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-500 transition-all text-white font-bold text-[11px] rounded-lg shadow-md">
                        + Buat Analisis Baru
                    </a>
                </div>
                <div class="p-8 text-center space-y-2">
                    <div class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-slate-900 border border-slate-800 text-slate-600">
                        📊
                    </div>
                    <h5 class="text-xs font-bold text-slate-400">Belum Ada Data Rekomendasi</h5>
                    <p class="text-[11px] text-slate-500 max-w-xs mx-auto">Silakan klik menu "Input Minat & Kriteria" untuk memasukkan bobot preferensi agar sistem SAW dapat menghitung urutan rekomendasi.</p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>