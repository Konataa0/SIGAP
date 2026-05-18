<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\NilaiKegiatanController;

// ─── Halaman utama ────────────────────────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
});

// ─── Route yang butuh login ───────────────────────────────────────────────────
Route::middleware(['auth'])->group(function () {

    // Dashboard (view dibuat Anggota 2)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ── Rekomendasi SAW (Mahasiswa) ───────────────────────────────────────────
    // Form preferensi (view dibuat Anggota 2)
    Route::get('/rekomendasi', function () {
        $kriteria = \App\Models\Kriteria::orderBy('kode')->get();
        return view('rekomendasi.form', compact('kriteria'));
    })->name('rekomendasi.form');

    // Proses hitung SAW
    Route::post('/rekomendasi', [KegiatanController::class, 'prosesRekomendasi'])
         ->name('rekomendasi.proses');

    // Halaman hasil rekomendasi (view dibuat Anggota 2)
    Route::get('/rekomendasi/hasil', [KegiatanController::class, 'hasilRekomendasi'])
         ->name('rekomendasi.hasil');

    // ── Route khusus Admin ────────────────────────────────────────────────────
    Route::middleware(['role:admin'])->group(function () {

        // CRUD Kegiatan
        Route::resource('kegiatan', KegiatanController::class);

        // CRUD Kriteria + Bobot
        Route::resource('kriteria', KriteriaController::class);

        // Isi nilai kegiatan (matriks SAW)
        Route::get('/nilai-kegiatan/{kegiatan}',  [NilaiKegiatanController::class, 'edit'])
             ->name('nilai-kegiatan.edit');
        Route::post('/nilai-kegiatan/{kegiatan}', [NilaiKegiatanController::class, 'update'])
             ->name('nilai-kegiatan.update');
    });
});

// ─── Auth routes (login, register, logout) ────────────────────────────────────
// Dibuat oleh Anggota 3 pakai Laravel Breeze.
// Uncomment baris ini setelah Anggota 3 install Breeze:
// require __DIR__.'/auth.php';