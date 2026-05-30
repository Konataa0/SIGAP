<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Kegiatan</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { sans: ['Manrope', 'sans-serif'] } } } }
    </script>
</head>
<body class="bg-slate-950 text-slate-100 font-sans min-h-screen">
    <main class="max-w-6xl mx-auto px-6 py-16 space-y-8">
        <div class="flex items-end justify-between gap-4 flex-wrap">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.25em] text-cyan-400">Kegiatan Ringkas</p>
                <h1 class="mt-3 text-3xl md:text-4xl font-extrabold tracking-tight">Daftar kegiatan yang bisa dilihat guest</h1>
                <p class="mt-3 text-slate-400">Guest hanya melihat nama dan kategori. Detail lengkap tersedia setelah login.</p>
            </div>
            <a href="{{ route('home') }}" class="inline-flex items-center rounded-xl border border-slate-700 px-4 py-2 text-sm font-semibold text-slate-200">Kembali</a>
        </div>

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            @forelse($kegiatan as $item)
                <article class="rounded-2xl border border-slate-800 bg-slate-900 p-5 shadow-lg shadow-slate-950/30">
                    <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-cyan-400">{{ strtoupper($item->jenis) }}</p>
                    <h2 class="mt-2 text-xl font-bold text-white">{{ $item->nama }}</h2>
                    <p class="mt-3 text-sm text-slate-400">Kategori: {{ ucfirst($item->jenis) }}</p>
                </article>
            @empty
                <div class="rounded-2xl border border-slate-800 bg-slate-900 p-8 text-slate-400">Belum ada kegiatan tersedia.</div>
            @endforelse
        </div>
    </main>
</body>
</html>
