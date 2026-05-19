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
                            50: '#eff6ff',
                            100: '#dbeafe',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-100 text-slate-900 font-sans">
    <div class="relative overflow-hidden">
        <div class="absolute -top-40 -right-28 h-96 w-96 rounded-full bg-brand-100 blur-3xl"></div>
        <div class="absolute top-64 -left-20 h-80 w-80 rounded-full bg-sky-100 blur-3xl"></div>

        <header class="relative z-10">
            <div class="max-w-6xl mx-auto px-6 py-6 flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <span class="h-10 w-10 rounded-xl bg-brand-700 text-white grid place-items-center font-extrabold">SG</span>
                    <div>
                        <p class="font-extrabold tracking-tight">SIGAP</p>
                        <p class="text-xs text-slate-500 -mt-0.5">Smart Campus Activity Picker</p>
                    </div>
                </a>

                <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-600">
                    <a href="#fitur" class="hover:text-brand-700">Fitur</a>
                    <a href="#manfaat" class="hover:text-brand-700">Manfaat</a>
                    <a href="#aksi" class="hover:text-brand-700">Mulai</a>
                </nav>

                <div class="hidden md:flex items-center gap-3">
                    @guest
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg text-sm font-semibold border border-slate-300 text-slate-700 hover:border-brand-200 hover:text-brand-700">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg text-sm font-semibold bg-brand-700 text-white hover:bg-brand-600">Register</a>
                    @endguest

                    @auth
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg text-sm font-semibold border border-slate-300 text-slate-700 hover:border-brand-200 hover:text-brand-700">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="px-4 py-2 rounded-lg text-sm font-semibold bg-slate-900 text-white hover:bg-slate-800">Logout</button>
                        </form>
                    @endauth
                </div>
            </div>
        </header>

        <main class="relative z-10">
            <section class="max-w-6xl mx-auto px-6 pb-12 pt-4 md:pt-10">
                <div class="grid md:grid-cols-2 gap-10 items-center">
                    <div>
                        <p class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-[0.2em] text-brand-700 bg-brand-50 border border-brand-100 px-3 py-1 rounded-full">
                            Platform SPK Mahasiswa
                        </p>

                        <h1 class="mt-5 text-4xl md:text-5xl font-extrabold leading-tight text-slate-900">
                            Pilih Kegiatan Kampus
                            <span class="text-brand-700">Lebih Tepat</span>
                            Berdasarkan Data.
                        </h1>

                        <p class="mt-5 text-slate-600 text-lg leading-relaxed max-w-xl">
                            SIGAP membantu mahasiswa menemukan kegiatan paling sesuai menggunakan metode SAW, sehingga keputusan ikut organisasi, lomba, atau pelatihan jadi lebih objektif.
                        </p>

                        <div id="aksi" class="mt-8 flex flex-wrap gap-3">
                            @guest
                                <a href="{{ route('register') }}" class="px-6 py-3 rounded-xl bg-brand-700 text-white font-semibold hover:bg-brand-600 transition-colors">
                                    Daftar Mahasiswa
                                </a>
                                <a href="{{ route('login') }}" class="px-6 py-3 rounded-xl bg-white border border-slate-300 text-slate-700 font-semibold hover:border-brand-200 hover:text-brand-700 transition-colors">
                                    Login
                                </a>
                            @endguest

                            @auth
                                <a href="{{ route('rekomendasi.form') }}" class="px-6 py-3 rounded-xl bg-brand-700 text-white font-semibold hover:bg-brand-600 transition-colors">
                                    Mulai Penilaian
                                </a>
                            @endauth

                            <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-xl bg-white border border-slate-300 text-slate-700 font-semibold hover:border-brand-200 hover:text-brand-700 transition-colors">
                                Lihat Dashboard
                            </a>
                        </div>
                    </div>

                    <div class="rounded-3xl bg-gradient-to-br from-brand-900 via-brand-700 to-sky-500 p-1 shadow-2xl shadow-brand-200/80">
                        <div class="rounded-[22px] bg-white p-6">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="rounded-2xl bg-slate-50 p-4 border border-slate-200">
                                    <p class="text-xs font-semibold text-slate-500">Akurasi Seleksi</p>
                                    <p class="mt-2 text-2xl font-extrabold text-brand-700">95%</p>
                                </div>
                                <div class="rounded-2xl bg-slate-50 p-4 border border-slate-200">
                                    <p class="text-xs font-semibold text-slate-500">Waktu Proses</p>
                                    <p class="mt-2 text-2xl font-extrabold text-brand-700">&lt; 3 mnt</p>
                                </div>
                                <div class="col-span-2 rounded-2xl bg-slate-900 p-5 text-slate-100">
                                    <p class="text-xs text-slate-400">Ringkasan Sistem</p>
                                    <p class="mt-2 font-semibold">Kriteria + bobot + preferensi mahasiswa diproses untuk menghasilkan ranking kegiatan yang dapat ditindaklanjuti.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="fitur" class="max-w-6xl mx-auto px-6 py-8 md:py-14">
                <div class="grid md:grid-cols-3 gap-5">
                    <article class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                        <h3 class="text-lg font-extrabold">Rekomendasi Otomatis</h3>
                        <p class="mt-2 text-slate-600">Perankingan kegiatan berjalan otomatis berdasarkan bobot prioritas yang Anda masukkan.</p>
                    </article>
                    <article class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                        <h3 class="text-lg font-extrabold">Role-Based Access</h3>
                        <p class="mt-2 text-slate-600">Akses admin dan mahasiswa dipisahkan agar data tetap aman dan alur kerja lebih tertib.</p>
                    </article>
                    <article class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                        <h3 class="text-lg font-extrabold">Siap untuk Kampus</h3>
                        <p class="mt-2 text-slate-600">Dirancang untuk penggunaan nyata di lingkungan kampus dengan UI yang responsif.</p>
                    </article>
                </div>
            </section>

            <section id="manfaat" class="max-w-6xl mx-auto px-6 pb-16">
                <div class="rounded-3xl bg-slate-900 p-8 md:p-10 text-white">
                    <h2 class="text-2xl md:text-3xl font-extrabold">Keputusan Lebih Cepat, Partisipasi Lebih Tepat</h2>
                    <p class="mt-3 text-slate-300 max-w-3xl">Dengan SIGAP, mahasiswa dapat fokus pada kegiatan yang benar-benar relevan dengan potensi mereka, sementara admin memperoleh alat bantu pengelolaan kegiatan yang terstruktur.</p>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
