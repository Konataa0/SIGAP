<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Mahasiswa | SIGAP</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[#030712] font-sans text-slate-200 antialiased">
    <div class="min-h-screen grid lg:grid-cols-2">
        
        {{-- Sisi Kiri: Panel Visual Branding (Dark Glow) --}}
        <section class="hidden lg:flex flex-col items-center justify-center relative overflow-hidden bg-gradient-to-br from-slate-950 via-[#0b0f19] to-slate-950 p-12 border-r border-slate-900">
            {{-- Efek cahaya latar belakang (Ambient Glow) --}}
            <div class="absolute w-80 h-80 bg-indigo-600/10 blur-3xl rounded-full -top-10 -left-10 pointer-events-none"></div>
            <div class="absolute w-96 h-96 bg-blue-600/10 blur-3xl rounded-full -bottom-16 -right-16 pointer-events-none"></div>

            <div class="max-w-md w-full relative z-10 space-y-6">
                {{-- Logo Aplikasi --}}
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-600 text-white font-black text-2xl shadow-lg shadow-indigo-600/30">
                    SG
                </div>
                
                <div class="space-y-3">
                    <p class="text-xs uppercase tracking-[0.25em] font-extrabold text-indigo-400">SIGAP REGISTRATION</p>
                    <h1 class="text-4xl font-black text-white leading-tight tracking-tight">
                        Daftar akun mahasiswa dan mulai eksplorasi kegiatan kampus.
                    </h1>
                </div>
                
                <p class="text-slate-400 text-sm leading-relaxed">
                    Pendaftaran publik hanya terbuka untuk <span class="text-indigo-400 font-semibold">Mahasiswa</span>. Akses akun admin dikelola secara terpisah melalui sistem database seeder atau manajemen internal instruktur.
                </p>
            </div>
        </section>

        {{-- Sisi Kanan: Form Register (Dark Card Panel) --}}
        <section class="flex items-center justify-center p-6 bg-gradient-to-tr from-slate-950 to-[#070a13]">
            <div class="w-full max-w-md bg-slate-900/40 border border-slate-800/80 rounded-2xl shadow-2xl backdrop-blur-sm p-8 md:p-10 space-y-6">
                
                <div>
                    <a href="{{ route('home') }}" class="inline-flex items-center text-xs font-bold text-indigo-400 hover:text-indigo-300 transition-all gap-1">
                        ← Kembali ke Beranda
                    </a>
                    <h2 class="mt-4 text-2xl font-black text-white tracking-tight">Register Mahasiswa</h2>
                    <p class="text-slate-400 mt-1 text-xs">Isi data diri kamu di bawah ini untuk membuat akun mahasiswa baru.</p>
                </div>

                <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
                    @csrf

                    {{-- Input Nama --}}
                    <div>
                        <label for="name" class="block text-xs font-semibold text-slate-300 mb-1.5">Nama Lengkap</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required 
                               class="w-full rounded-xl bg-slate-950 border border-slate-800 px-4 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/10 placeholder:text-slate-600 transition-all"
                               placeholder="Masukkan nama lengkap Anda">
                        @error('name')
                            <p class="text-xs text-rose-500 mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Input Email --}}
                    <div>
                        <label for="email" class="block text-xs font-semibold text-slate-300 mb-1.5">Alamat Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required 
                               class="w-full rounded-xl bg-slate-950 border border-slate-800 px-4 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/10 placeholder:text-slate-600 transition-all"
                               placeholder="nama@mahasiswa.it">
                        @error('email')
                            <p class="text-xs text-rose-500 mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Input Password --}}
                    <div>
                        <label for="password" class="block text-xs font-semibold text-slate-300 mb-1.5">Password</label>
                        <input id="password" name="password" type="password" required 
                               class="w-full rounded-xl bg-slate-950 border border-slate-800 px-4 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/10 placeholder:text-slate-600 transition-all"
                               placeholder="Minimal 8 karakter">
                        @error('password')
                            <p class="text-xs text-rose-500 mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Input Konfirmasi Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-xs font-semibold text-slate-300 mb-1.5">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required 
                               class="w-full rounded-xl bg-slate-950 border border-slate-800 px-4 py-2.5 text-sm text-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/10 placeholder:text-slate-600 transition-all"
                               placeholder="Ulangi password Anda">
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="pt-2">
                        <button type="submit" class="w-full py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold shadow-lg shadow-indigo-600/10 transition-all duration-200">
                            Daftar Sekarang
                        </button>
                    </div>
                </form>

                {{-- Tautan Balik ke Login --}}
                <div class="border-t border-slate-800/60 pt-4 text-center">
                    <p class="text-xs text-slate-500">
                        Sudah memiliki akun?
                        <a href="{{ route('login') }}" class="font-bold text-indigo-400 hover:text-indigo-300 hover:underline ml-1">
                            Login sekarang
                        </a>
                    </p>
                </div>

            </div>
        </section>

    </div>
</body>
</html>