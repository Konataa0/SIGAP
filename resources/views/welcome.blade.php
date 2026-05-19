<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-950 text-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGAP - Smart Campus Activity Picker</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full font-sans antialiased bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-indigo-950/40 via-slate-950 to-slate-950">

    <nav class="border-b border-slate-900 bg-slate-950/60 backdrop-blur-xl sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-600 text-white font-black text-sm shadow-md shadow-indigo-600/20">
                        SG
                    </div>
                    <div>
                        <span class="text-base font-bold text-white tracking-wide block leading-none">SIGAP</span>
                        <span class="text-[10px] text-indigo-400 font-medium tracking-wider uppercase">Smart Campus Activity Picker</span>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-slate-900 hover:bg-slate-800 text-slate-200 text-xs font-semibold rounded-xl border border-slate-800 transition-all duration-200">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-xl shadow-lg shadow-indigo-600/10 transition-all duration-200">
                                Masuk Sistem
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-xs font-semibold text-indigo-400 uppercase tracking-wider">
                    Platform SPK Mahasiswa IT
                </span>
                <h1 class="text-4xl sm:text-5xl font-extrabold text-white tracking-tight leading-none">
                    Pilih Kegiatan Kampus <br class="hidden sm:inline">
                    <span class="bg-gradient-to-r from-indigo-400 via-violet-400 to-indigo-200 bg-clip-text text-transparent">Lebih Tepat Berdasarkan Data</span>.
                </h1>
                <p class="text-base text-slate-400 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                    SIGAP membantu mahasiswa menemukan kegiatan paling sesuai menggunakan metode <span class="text-indigo-400 font-semibold">Simple Additive Weighting (SAW)</span>, sehingga keputusan ikut organisasi, lomba, atau sertifikasi kompetensi jadi lebih objektif dan akurat.
                </p>
                <div class="pt-4 flex flex-wrap gap-4 justify-center lg:justify-start">
                    <a href="{{ route('login') }}" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-sm rounded-xl transition-all duration-200 shadow-lg shadow-indigo-600/20 flex items-center gap-2 group">
                        Mulai Penilaian
                        <svg class="w-4 h-4 text-indigo-200 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                    <a href="{{ url('/dashboard') }}" class="px-6 py-3 bg-slate-900 hover:bg-slate-800 text-slate-300 font-medium text-sm rounded-xl border border-slate-800 transition-all duration-200">
                        Lihat Dashboard
                    </a>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="relative p-6 bg-gradient-to-b from-slate-900 to-slate-950 border border-slate-800 rounded-3xl shadow-2xl space-y-6">
                    <div class="absolute -top-3 -right-3 w-20 h-20 bg-indigo-500/10 blur-xl rounded-full"></div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 bg-slate-950/60 border border-slate-900 rounded-2xl">
                            <span class="text-[10px] text-slate-500 font-bold uppercase tracking-wider block">Akurasi Seleksi</span>
                            <span class="text-2xl font-black text-indigo-400 mt-1 block">95%</span>
                        </div>
                        <div class="p-4 bg-slate-950/60 border border-slate-900 rounded-2xl">
                            <span class="text-[10px] text-slate-500 font-bold uppercase tracking-wider block">Waktu Proses</span>
                            <span class="text-2xl font-black text-violet-400 mt-1 block">&lt; 3 Detik</span>
                        </div>
                    </div>

                    <div class="p-4 bg-indigo-950/20 border border-indigo-900/30 rounded-2xl space-y-2">
                        <span class="text-xs font-bold text-white flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-400 animate-pulse"></span>
                            Ringkasan Alur Kerja Engine SAW
                        </span>
                        <p class="text-xs text-slate-400 leading-relaxed">
                            Kriteria + bobot + preferensi mahasiswa diproses melalui normalisasi matriks untuk menghasilkan ranking kegiatan yang dapat ditindaklanjuti secara instan.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-24 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-5 bg-slate-900/20 border border-slate-900 rounded-2xl space-y-2">
                <div class="h-8 w-8 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center font-bold text-sm">01</div>
                <h3 class="text-sm font-bold text-white">Rekomendasi Otomatis</h3>
                <p class="text-xs text-slate-400 leading-relaxed">Perankingan kegiatan berjalan otomatis berdasarkan bobot prioritas yang Anda masukkan pada form kriteria.</p>
            </div>
            <div class="p-5 bg-slate-900/20 border border-slate-900 rounded-2xl space-y-2">
                <div class="h-8 w-8 rounded-lg bg-violet-500/10 border border-violet-500/20 text-violet-400 flex items-center justify-center font-bold text-sm">02</div>
                <h3 class="text-sm font-bold text-white">Role-Based Access</h3>
                <p class="text-xs text-slate-400 leading-relaxed">Akses panel admin dan mahasiswa dipisahkan secara ketat agar data alternatif kegiatan tetap aman dan terstruktur.</p>
            </div>
            <div class="p-5 bg-slate-900/20 border border-slate-900 rounded-2xl space-y-2">
                <div class="h-8 w-8 rounded-lg bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold text-sm">03</div>
                <h3 class="text-sm font-bold text-white">Siap untuk Kampus</h3>
                <p class="text-xs text-slate-400 leading-relaxed">Dirancang khusus untuk memetakan minat mahasiswa ke ranah Sertifikasi, Lomba Nasional, maupun UKM secara responsif.</p>
            </div>
        </div>
    </main>

</body>
</html>