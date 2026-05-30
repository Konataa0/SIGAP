<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang SIGAP</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { sans: ['Manrope', 'sans-serif'] } } } }
    </script>
</head>
<body class="bg-slate-950 text-slate-100 font-sans min-h-screen">
    <main class="max-w-5xl mx-auto px-6 py-16 space-y-8">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.25em] text-cyan-400">Tentang SIGAP</p>
            <h1 class="mt-3 text-4xl font-extrabold tracking-tight">Sistem rekomendasi kegiatan pengembangan diri mahasiswa IT.</h1>
            <p class="mt-4 text-slate-400 leading-relaxed max-w-3xl">SIGAP membantu mahasiswa menemukan kegiatan yang relevan berdasarkan minat teknis, target karir, ketersediaan waktu, dan tujuan pengembangan diri.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-4">
            <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
                <h2 class="font-bold text-white">Landing</h2>
                <p class="mt-2 text-sm text-slate-400">Ringkasan singkat sistem dan akses awal untuk guest.</p>
            </div>
            <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
                <h2 class="font-bold text-white">Daftar Kegiatan</h2>
                <p class="mt-2 text-sm text-slate-400">Guest hanya melihat nama dan kategori kegiatan.</p>
            </div>
            <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5">
                <h2 class="font-bold text-white">Akses Mahasiswa</h2>
                <p class="mt-2 text-sm text-slate-400">Detail, rekomendasi SAW, bookmark, dan histori tersedia setelah login.</p>
            </div>
        </div>

        <a href="{{ route('home') }}" class="inline-flex items-center rounded-xl bg-cyan-500 px-5 py-3 font-semibold text-slate-950">Kembali ke Beranda</a>
    </main>
</body>
</html>
