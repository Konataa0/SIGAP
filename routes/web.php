<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// 1. Mengarahkan halaman utama langsung ke Dashboard UI buatanmu
Route::get('/', function () {
    return view('home');
})->name('home');

// Auth untuk tamu (guest): login & register mahasiswa
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// 2. Jalur Dashboard Utama
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// 3. Jalur Form Input Minat & Kriteria (Disertai Data Dummy agar tidak error)
Route::get('/rekomendasi/form', function () {
    $kriteria = [
        (object)['id' => 1, 'nama_kriteria' => 'Prestasi Akademik / IPK', 'kode' => 'C1', 'jenis' => 'benefit'],
        (object)['id' => 2, 'nama_kriteria' => 'Minat Bakat Coding & Core IT', 'kode' => 'C2', 'jenis' => 'benefit'],
        (object)['id' => 3, 'nama_kriteria' => 'Ketersediaan Waktu Sisa', 'kode' => 'C3', 'jenis' => 'benefit'],
        (object)['id' => 4, 'nama_kriteria' => 'Biaya Pendaftaran Kegiatan', 'kode' => 'C4', 'jenis' => 'cost'],
    ];
    return view('rekomendasi.form', compact('kriteria'));
})->name('rekomendasi.form');

// 4. Jalur Halaman Hasil Analisis Perankingan SAW
Route::get('/rekomendasi/hasil', function () {
    return view('rekomendasi.hasil');
})->name('rekomendasi.hasil');

// Jalur bayangan untuk tombol submit form proses
Route::post('/rekomendasi/proses', function () {
    return redirect()->route('rekomendasi.hasil');
})->name('rekomendasi.proses');

// Tambahkan baris ini di bagian paling bawah file routes/web.php kamu

// 5-6. Rute Admin dibungkus dengan middleware role:admin
Route::middleware(['role:admin'])->group(function () {
    // Kelola Kegiatan (Admin)
    Route::get('/admin/kegiatan', function () {
        return view('kegiatan.index');
    })->name('kegiatan.index');

    // Manajemen Kriteria (Admin)
    Route::get('/admin/kriteria', function () {
        return view('kriteria.index');
    })->name('kriteria.index');
<<<<<<< HEAD

    Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');
});
=======
});
>>>>>>> 409f46d2c0a2d7f621750e1b60bf38135fd6931e
