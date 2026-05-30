<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\Mahasiswa\BookmarkController;
use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\Mahasiswa\KeikutsertaanController;
use App\Http\Controllers\Mahasiswa\KegiatanController as MahasiswaKegiatanController;
use App\Http\Controllers\Mahasiswa\ProfilController;
use App\Http\Controllers\Mahasiswa\RekomendasiHistoryController;
use App\Http\Controllers\PublicKegiatanController;
use Illuminate\Support\Facades\Route;

// ── Halaman publik ────────────────────────────────────────────────────────────
Route::get('/', fn() => view('home'))->name('home');
Route::view('/tentang', 'tentang')->name('tentang');
Route::get('/kegiatan', [PublicKegiatanController::class, 'index'])->name('kegiatan.public');

// ── Auth (tamu) ───────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register'])->name('register.store');
});

// ── Auth (sudah login) ────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// ── Dashboard Mahasiswa ───────────────────────────────────────────────────────
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('mahasiswa.dashboard');

    Route::get('/bookmark', [BookmarkController::class, 'index'])->name('mahasiswa.bookmark.index');
    Route::post('/kegiatan/{kegiatan}/bookmark', [BookmarkController::class, 'toggle'])->name('mahasiswa.bookmark.toggle');

    Route::post('/kegiatan/{kegiatan}/status', [KeikutsertaanController::class, 'upsert'])->name('mahasiswa.keikutsertaan.upsert');

    Route::get('/histori-rekomendasi', [RekomendasiHistoryController::class, 'index'])->name('mahasiswa.history.index');
    Route::get('/histori-rekomendasi/{hasilRekomendasi}', [RekomendasiHistoryController::class, 'show'])->name('mahasiswa.history.show');

    Route::get('/profil', [ProfilController::class, 'show'])->name('mahasiswa.profil.show');
    Route::put('/profil', [ProfilController::class, 'update'])->name('mahasiswa.profil.update');
});

// ── SPK: Form preferensi + proses SAW + hasil ─────────────────────────────────
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->group(function () {
    Route::get('/rekomendasi/form',
        [KegiatanController::class, 'formRekomendasi'])->name('rekomendasi.form');

    // ↑ Sebelumnya closure dummy dengan $kriteria hardcoded.
    //   Sekarang terhubung ke controller agar kriteria diambil dari DB.

    Route::post('/rekomendasi/proses',
        [KegiatanController::class, 'prosesRekomendasi'])->name('rekomendasi.proses');

    Route::get('/rekomendasi/hasil',
        [KegiatanController::class, 'hasilRekomendasi'])->name('rekomendasi.hasil');

    Route::get('/kegiatan/{kegiatan}', [MahasiswaKegiatanController::class, 'show'])->name('mahasiswa.kegiatan.show');
});

// ── Redirect lama agar kompatibel sementara ───────────────────────────────────
Route::redirect('/dashboard', '/mahasiswa/dashboard');

// ── Admin: hanya role admin ───────────────────────────────────────────────────
Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard admin
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

    // CRUD Kegiatan — sebelumnya pakai closure dummy, sekarang ke controller
    Route::get('/kegiatan',              [KegiatanController::class, 'index'])->name('kegiatan.index');
    Route::get('/kegiatan/create',       [KegiatanController::class, 'create'])->name('kegiatan.create');
    Route::post('/kegiatan',             [KegiatanController::class, 'store'])->name('kegiatan.store');
    Route::get('/kegiatan/{kegiatan}/edit',   [KegiatanController::class, 'edit'])->name('kegiatan.edit');
    Route::put('/kegiatan/{kegiatan}',        [KegiatanController::class, 'update'])->name('kegiatan.update');
    Route::delete('/kegiatan/{kegiatan}',     [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');
});