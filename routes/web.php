<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KegiatanController;
use Illuminate\Support\Facades\Route;

// ── Halaman publik ────────────────────────────────────────────────────────────
Route::get('/', fn() => view('home'))->name('home');

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
Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

// ── SPK: Form preferensi + proses SAW + hasil ─────────────────────────────────
Route::get('/rekomendasi/form',
    [KegiatanController::class, 'formRekomendasi'])->name('rekomendasi.form');
// ↑ Sebelumnya closure dummy dengan $kriteria hardcoded.
//   Sekarang terhubung ke controller agar kriteria diambil dari DB.

Route::post('/rekomendasi/proses',
    [KegiatanController::class, 'prosesRekomendasi'])->name('rekomendasi.proses');

Route::get('/rekomendasi/hasil',
    [KegiatanController::class, 'hasilRekomendasi'])->name('rekomendasi.hasil');

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