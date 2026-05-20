<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-950 text-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGAP - Form Preferensi</title>
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
                    <a href="{{ url('/dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-white rounded-xl hover:bg-slate-900/50 transition-all text-sm font-medium">
                        Dashboard
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-white bg-indigo-600/10 border border-indigo-500/20 rounded-xl text-sm font-semibold shadow-inner shadow-indigo-500/10">
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

        <main class="flex-1 p-6 md:p-10 overflow-y-auto max-w-5xl">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-white tracking-wide">Form Preferensi & Bobot Kriteria</h1>
                <p class="text-slate-400 text-sm mt-1">Tentukan prioritas nilai penentu menggunakan skala kepentingan untuk mengoptimalkan perangkingan SAW.</p>
            </div>

            <form action="{{ route('rekomendasi.proses') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="p-5 bg-slate-900/40 border border-slate-900 rounded-2xl space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-indigo-400 uppercase tracking-wider">Kriteria C1</span>
                            <span class="px-2 py-0.5 rounded-md bg-emerald-500/10 border border-emerald-500/20 text-[10px] font-medium text-emerald-400 uppercase">Benefit</span>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-white">Nilai Akademik (IPK)</h3>
                            <p class="text-xs text-slate-400 mt-1">Seberapa besar fokus kegiatan yang membutuhkan syarat standar IPK tinggi?</p>
                        </div>
                        <div class="space-y-2">
                            <input type="range" name="c1" min="1" max="5" value="3" class="w-full accent-indigo-500 h-1.5 bg-slate-800 rounded-lg appearance-none cursor-pointer">
                            <div class="flex justify-between text-[10px] text-slate-500 font-semibold px-1">
                                <span>1 (Sangat Rendah)</span>
                                <span>3 (Cukup)</span>
                                <span>5 (Sangat Penting)</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 bg-slate-900/40 border border-slate-900 rounded-2xl space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-indigo-400 uppercase tracking-wider">Kriteria C2</span>
                            <span class="px-2 py-0.5 rounded-md bg-emerald-500/10 border border-emerald-500/20 text-[10px] font-medium text-emerald-400 uppercase">Benefit</span>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-white">Minat Organisasi & Sosialisasi</h3>
                            <p class="text-xs text-slate-400 mt-1">Prioritas keaktifan dalam pengembangan soft skill dan jaringan sosial kampus.</p>
                        </div>
                        <div class="space-y-2">
                            <input type="range" name="c2" min="1" max="5" value="4" class="w-full accent-indigo-500 h-1.5 bg-slate-800 rounded-lg appearance-none cursor-pointer">
                            <div class="flex justify-between text-[10px] text-slate-500 font-semibold px-1">
                                <span>1 (Sangat Rendah)</span>
                                <span>3 (Cukup)</span>
                                <span>5 (Sangat Penting)</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 bg-slate-900/40 border border-slate-900 rounded-2xl space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-indigo-400 uppercase tracking-wider">Kriteria C3</span>
                            <span class="px-2 py-0.5 rounded-md bg-amber-500/10 border border-amber-500/20 text-[10px] font-medium text-amber-400 uppercase">Cost</span>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-white">Beban Waktu Kegiatan</h3>
                            <p class="text-xs text-slate-400 mt-1">Semakin tinggi bobot, semakin Anda menghindari kegiatan yang menyita banyak waktu kuliah.</p>
                        </div>
                        <div class="space-y-2">
                            <input type="range" name="c3" min="1" max="5" value="2" class="w-full accent-indigo-500 h-1.5 bg-slate-800 rounded-lg appearance-none cursor-pointer">
                            <div class="flex justify-between text-[10px] text-slate-500 font-semibold px-1">
                                <span>1 (Fleksibel)</span>
                                <span>3 (Sedang)</span>
                                <span>5 (Sangat Padat)</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 bg-slate-900/40 border border-slate-900 rounded-2xl space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-indigo-400 uppercase tracking-wider">Kriteria C4</span>
                            <span class="px-2 py-0.5 rounded-md bg-emerald-500/10 border border-emerald-500/20 text-[10px] font-medium text-emerald-400 uppercase">Benefit</span>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-white">Portofolio & Kesiapan Kerja</h3>
                            <p class="text-xs text-slate-400 mt-1">Bobot kepentingan kegiatan dalam menyumbang poin portofolio dunia industri.</p>
                        </div>
                        <div class="space-y-2">
                            <input type="range" name="c4" min="1" max="5" value="5" class="w-full accent-indigo-500 h-1.5 bg-slate-800 rounded-lg appearance-none cursor-pointer">
                            <div class="flex justify-between text-[10px] text-slate-500 font-semibold px-1">
                                <span>1 (Sangat Rendah)</span>
                                <span>3 (Cukup)</span>
                                <span>5 (Sangat Penting)</span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-sm rounded-xl transition-all shadow-lg shadow-indigo-600/20 flex items-center gap-2 cursor-pointer">
                        <span>Proses Perangkingan SAW</span>
                        <svg class="w-4 h-4 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </button>
                </div>
            </form>
        </main>
    </div>

</body>
</html>