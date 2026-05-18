<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIGAP - Dashboard Panel</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex font-sans">

    <aside class="w-64 bg-slate-900 border-r border-slate-800 flex flex-col justify-between shrink-0 hidden md:flex">
        <div class="p-6">
            <div class="flex items-center gap-3 mb-8">
                <div class="bg-indigo-600 text-white p-2 rounded-xl font-bold tracking-wider shadow-lg shadow-indigo-500/20">
                    SG
                </div>
                <div>
                    <h1 class="font-extrabold text-lg tracking-tight text-white">SIGAP Panel</h1>
                    <span class="text-[10px] text-indigo-400 font-semibold uppercase tracking-wider block -mt-0.5">
                        Mahasiswa IT
                    </span>
                </div>
            </div>

            <nav class="space-y-1">
                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block px-3 mb-2">Main Menu</span>
                
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('dashboard') || request()->is('/') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/10' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
                </a>

                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block px-3 pt-4 mb-2">Fitur SPK</span>
                <a href="{{ route('rekomendasi.form') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('rekomendasi.form') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/10' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                    <i data-lucide="sliders" class="w-4 h-4"></i> Input Minat & Kriteria
                </a>
                <a href="{{ route('rekomendasi.hasil') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('rekomendasi.hasil') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/10' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                    <i data-lucide="award" class="w-4 h-4"></i> Hasil Rekomendasi
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-slate-800 bg-slate-900/50">
            <div class="flex items-center justify-between gap-2 p-2 rounded-xl bg-slate-800/30">
                <div class="truncate">
                    <p class="text-xs font-bold text-white truncate">Hady Yusuf Pratama</p>
                    <p class="text-[10px] text-slate-500 truncate">hadynata@student.ac.id</p>
                </div>
                <a href="#" class="p-2 text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 rounded-lg transition-all">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
    </aside>

    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        <header class="h-16 border-b border-slate-800 bg-slate-950/80 backdrop-blur px-6 flex items-center justify-between sticky top-0 z-40">
            <h2 class="font-bold text-lg text-white">@yield('page_title', 'Dashboard')</h2>
            <div class="flex items-center gap-4">
                <span class="text-xs text-slate-400 bg-slate-900 px-3 py-1.5 rounded-lg border border-slate-800 font-medium">Semester Berjalan: Gasal 2026</span>
            </div>
        </header>

        <main class="p-6 lg:p-8 flex-1">
            @yield('content')
        </main>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>