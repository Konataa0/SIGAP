<?php

use Illuminate\Support\Facades\Route;

// 1. Mengarahkan halaman utama langsung ke Dashboard UI buatanmu
Route::get('/', function () {
    return view('dashboard');
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

// 5. Jalur Kelola Kegiatan (Admin)
Route::get('/admin/kegiatan', function () {
    return view('kegiatan.index');
})->name('kegiatan.index');

// 6. Jalur Manajemen Kriteria (Admin)
Route::get('/admin/kriteria', function () {
    return view('kriteria.index');
})->name('kcriteria.index'); // Sesuaikan dengan requestIs di master layout ('kcriteria.*')