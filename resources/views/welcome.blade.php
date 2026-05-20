<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SIGAP') }}</title>

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
<body class="bg-slate-950 text-slate-100 font-sans min-h-screen flex flex-col items-center justify-center p-6 relative overflow-hidden">
    
    <div class="absolute -top-40 -right-28 h-96 w-96 rounded-full bg-brand-900/30 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 -left-20 h-80 w-80 rounded-full bg-sky-900/20 blur-3xl pointer-events-none"></div>

    <header class="w-full max-w-4xl text-sm mb-12 relative z-10">
        @if (Route::has('login'))
            <nav class="flex items-center justify-between border-b border-slate-800/80 pb-4">
                <div class="flex items-center gap-2">
                    <span class="h-8 w-8 rounded-lg bg-brand-700 text-white grid place-items-center font-black text-xs">SG</span>
                    <span class="font-bold tracking-tight text-white">SIGAP</span>
                </div>
                
                <div class="flex items-center gap-4">
                    @else
                        <a href="{{ route('login') }}" class="inline-block text-slate-400 hover:text-white text-xs font-semibold transition-colors">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-block px-4 py-2 bg-brand-700 text-white hover:bg-brand-600 rounded-xl text-xs font-semibold shadow-lg shadow-brand-700/10 transition-all">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            </nav>
        @endif
    </header>

    <div class="w-full max-w-4xl flex items-center justify-center relative z-10 my-auto">
        <main class="w-full grid md:grid-cols-12 gap-8 bg-slate-900/50 border border-slate-800/80 rounded-3xl p-6 md:p-12 backdrop-blur-sm shadow-xl">
            <div class="md:col-span-7 flex flex-col justify-center">
                <h1 class="text-3xl font-black text-white tracking-tight leading-snug">
                    Selamat Datang di Portal <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-sky-400">Smart Campus Activity</span>
                </h1>
                <p class="mt-4 text-slate-400 text-sm leading-relaxed max-w-md">
                    Sistem pendukung keputusan berbasis web yang dirancang untuk membantu pemetaan dan rekomendasi keikutsertaan mahasiswa dalam program pengembangan diri secara objektif.
                </p>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-xl bg-brand-700 hover:bg-brand-600 text-white text-xs font-bold shadow-lg shadow-brand-700/20 transition-all">
                        Masuk ke Sistem &rarr;
                    </a>
                </div>
            </div>

            <div class="md:col-span-5 bg-slate-950/80 rounded-2xl border border-slate-800 p-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-xs font-bold uppercase tracking-widest text-brand-500 mb-3">Eksosistem Modul</h2>
                    <ul class="space-y-3 text-xs text-slate-400">
                        <li class="flex items-start gap-2.5">
                            <span class="text-brand-500 mt-0.5">&check;</span>
                            <span>Sistem Pemilihan Alternatif Berbasis SAW</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-brand-500 mt-0.5">&check;</span>
                            <span>Manajemen Kriteria & Pembobotan Kustom</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="text-brand-500 mt-0.5">&check;</span>
                            <span>Dashboard Pelaporan Hasil Pemeringkatan</span>
                        </li>
                    </ul>
                </div>
                
                <div class="mt-6 pt-4 border-t border-slate-800/60 text-[11px] text-slate-500 flex justify-between items-center">
                    <span>Engine: Laravel v{{ Illuminate\Foundation\Application::VERSION }}</span>
                    <span>PHP v{{ PHP_VERSION }}</span>
                </div>
            </div>
        </main>
    </div>

    <footer class="w-full text-center py-6 text-xs text-slate-600 relative z-10 mt-auto">
        &copy; 2026 SIGAP Platform. All rights reserved.
    </footer>
</body>
</html>