<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | SIGAP</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 font-sans text-slate-900">
    <div class="min-h-screen grid lg:grid-cols-2">
        <section class="hidden lg:flex items-center justify-center bg-gradient-to-br from-blue-900 via-blue-700 to-sky-500 p-10">
            <div class="max-w-md text-white">
                <p class="text-xs uppercase tracking-[0.2em] font-semibold text-blue-100">SIGAP Mahasiswa</p>
                <h1 class="mt-4 text-4xl font-extrabold leading-tight">Masuk untuk mulai rekomendasi kegiatan terbaikmu.</h1>
                <p class="mt-4 text-blue-100">Akun mahasiswa dapat menggunakan seluruh fitur rekomendasi berbasis SAW dengan alur yang cepat dan objektif.</p>
            </div>
        </section>

        <section class="flex items-center justify-center p-6">
            <div class="w-full max-w-md bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
                <a href="{{ route('home') }}" class="text-sm font-semibold text-blue-700 hover:text-blue-800">← Kembali ke Beranda</a>
                <h2 class="mt-5 text-2xl font-extrabold">Login</h2>
                <p class="text-slate-500 mt-1 text-sm">Masuk menggunakan akun yang sudah terdaftar.</p>

                <form method="POST" action="{{ route('login.store') }}" class="mt-6 space-y-4">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-semibold mb-1">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required class="w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        @error('email')
                            <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold mb-1">Password</label>
                        <input id="password" name="password" type="password" required class="w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    </div>

                    <label class="flex items-center gap-2 text-sm text-slate-600">
                        <input type="checkbox" name="remember" class="rounded border-slate-300">
                        Ingat saya
                    </label>

                    <button type="submit" class="w-full py-2.5 rounded-xl bg-blue-700 text-white font-semibold hover:bg-blue-600">Masuk</button>
                </form>

                <p class="mt-5 text-sm text-slate-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold text-blue-700 hover:text-blue-800">Daftar sebagai Mahasiswa</a>
                </p>
            </div>
        </section>
    </div>
</body>
</html>
