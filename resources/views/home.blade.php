<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIGAP | Sistem Rekomendasi Kegiatan Mahasiswa</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Manrope', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#020d20',
                            100: '#1e293b',
                            600: '#3b82f6',
                            700: '#2563eb',
                            800: '#1d4ed8',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-950 text-slate-100 font-sans min-h-screen selection:bg-brand-700 selection:text-white">
    <div class="relative overflow-hidden min-h-screen flex flex-col justify-between">
        <div class="absolute -top-40 -right-28 h-96 w-96 rounded-full bg-brand-900/40 blur-3xl pointer-events-none"></div>
        <div class="absolute top-64 -left-20 h-80 w-80 rounded-full bg-sky-900/30 blur-3xl pointer-events-none"></div>

        <header class="relative z-10 border-b border-slate-800/60 bg-slate-950/50 backdrop-blur-md">
            <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <span class="h-10 w-10 rounded-xl bg-brand-700 text-white grid place-items-center font-extrabold shadow-lg shadow-brand-700/20 group-hover:bg-brand-600 transition-colors">SG</span>
                    <div>
                        <p class="font-extrabold tracking-tight text-white">SIGAP</p>
                        <p class="text-[10px] text-slate-400 tracking-wide uppercase -mt-0.5">Smart Campus Activity Picker</p>
                    </div>
                </a>

                <div class="flex items-center gap-3">
                    @guest
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg text-sm font-semibold text-slate-300 hover:text-white hover:bg-slate-800/60 transition-all">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg text-sm font-semibold bg-brand-700 text-white hover:bg-brand-600 shadow-lg shadow-brand-700/20 transition-all">Register</a>
                    @endguest

                    @auth
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg text-sm font-semibold border border-slate-700 text-slate-300 hover:border-slate-500 hover:text-white transition-all">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 rounded-lg text-sm font-semibold bg-slate-800 text-slate-200 hover:bg-slate-700 transition-all">Logout</button>
                        </form>
                    @endauth
                </div>
            </div>
        </header>

        <main class="relative z-10 flex-grow flex items-center justify-center">
            <div class="max-w-6xl w-full mx-auto px-6 py-12 md:py-20">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <p class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.2em] text-brand-600 bg-brand-900/50 border border-brand-800/60 px-3 py-1.5 rounded-full">
                            Platform SPK Mahasiswa
                        </p>

                        <h1 class="mt-5 text-4xl md:text-5xl font-extrabold leading-tight text-white tracking-tight">
                            Pilih Kegiatan Kampus
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-sky-400">Lebih Tepat</span>
                            Berdasarkan Data.
                        </h1>

                        <p class="mt-5 text-slate-400 text-base md:text-lg leading-relaxed max-w-xl">
                            SIGAP membantu mahasiswa menemukan kegiatan paling sesuai menggunakan metode <strong>SAW (Simple Additive Weighting)</strong>, sehingga keputusan ikut organisasi, lomba, atau pelatihan jadi lebih objektif.
                        </p>

                        <div id="aksi" class="mt-8 flex flex-wrap gap-3">
                            @guest
                                <a href="{{ route('register') }}" class="px-6 py-3 rounded-xl bg-brand-700 text-white font-semibold hover:bg-brand-600 shadow-lg shadow-brand-700/20 transition-all">
                                    Daftar Mahasiswa
                                </a>
                                <a href="{{ route('login') }}" class="px-6 py-3 rounded-xl bg-slate-900 border border-slate-800 text-slate-300 font-semibold hover:border-slate-700 hover:text-white transition-all">
                                    Login
                                </a>
                            @endguest

                            @auth
                                <a href="{{ route('rekomendasi.form') }}" class="px-6 py-3 rounded-xl bg-brand-700 text-white font-semibold hover:bg-brand-600 shadow-lg shadow-brand-700/20 transition-all">
                                    Mulai Penilaian
                                </a>
                            @endauth

                        </div>
                    </div>

                    <div class="rounded-3xl bg-gradient-to-br from-brand-900 via-brand-700 to-sky-600 p-[1px] shadow-2xl shadow-brand-900/40">
                        <div class="rounded-[23px] bg-slate-900/95 p-6 backdrop-blur-md">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="rounded-2xl bg-slate-950 p-4 border border-slate-800/80">
                                    <p class="text-xs font-semibold text-slate-400">Akurasi Seleksi</p>
                                    <p class="mt-2 text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-sky-400">95%</p>
                                </div>
                                <div class="rounded-2xl bg-slate-950 p-4 border border-slate-800/80">
                                    <p class="text-xs font-semibold text-slate-400">Waktu Proses</p>
                                    <p class="mt-2 text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-sky-400">&lt; 3 mnt</p>
                                </div>
                                <div class="col-span-2 rounded-2xl bg-slate-950 p-5 border border-slate-800 text-slate-300">
                                    <p class="text-xs text-slate-400 font-medium uppercase tracking-wider mb-1">Ringkasan Sistem</p>
                                    <p class="text-sm leading-relaxed">Kriteria, bobot, dan preferensi mahasiswa diproses langsung untuk menghasilkan ranking kegiatan yang objektif dan akurat.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <section id="fitur" class="mt-16 md:mt-24">
                    <div class="grid md:grid-cols-3 gap-6">
                        <article class="bg-slate-900/60 rounded-2xl p-6 border border-slate-800/80 backdrop-blur-sm hover:border-slate-700 transition-all">
                            <h3 class="text-lg font-bold text-white">Rekomendasi Otomatis</h3>
                            <p class="mt-2 text-slate-400 text-sm leading-relaxed">Perankingan kegiatan berjalan otomatis berdasarkan bobot prioritas yang Anda masukkan melalui sistem SAW.</p>
                        </article>
                        <article class="bg-slate-900/60 rounded-2xl p-6 border border-slate-800/80 backdrop-blur-sm hover:border-slate-700 transition-all">
                            <h3 class="text-lg font-bold text-white">Role-Based Access</h3>
                            <p class="mt-2 text-slate-400 text-sm leading-relaxed">Akses admin dan mahasiswa dipisahkan secara ketat agar keamanan data dan alur manajemen rekap tetap terjaga.</p>
                        </article>
                        <article class="bg-slate-900/60 rounded-2xl p-6 border border-slate-800/80 backdrop-blur-sm hover:border-slate-700 transition-all">
                            <h3 class="text-lg font-bold text-white">Siap untuk Kampus</h3>
                            <p class="mt-2 text-slate-400 text-sm leading-relaxed">Dirancang khusus untuk lingkungan akademik nyata dengan antarmuka yang modern, responsif, dan intuitif.</p>
                        </article>
                    </div>
                </section>

                <section id="manfaat" class="mt-10">
                    <div class="rounded-2xl bg-gradient-to-r from-slate-900 to-brand-950 p-6 md:p-8 border border-slate-800 text-left">
                        <h2 class="text-xl md:text-2xl font-extrabold text-white">Keputusan Lebih Cepat, Partisipasi Lebih Tepat</h2>
                        <p class="mt-2 text-slate-400 text-sm md:text-base max-w-3xl leading-relaxed">
                            Dengan SIGAP, mahasiswa dapat fokus pada kegiatan yang benar-benar relevan dengan potensi mereka, sementara admin memperoleh alat bantu pengelolaan kegiatan yang terstruktur.
                        </p>
                    </div>
                </section>
            </div>
        </main>
    </div>
</body>
</html>