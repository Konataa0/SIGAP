<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';

    protected $fillable = [
        'nama',
        'jenis',
        'deskripsi',
        'penyelenggara',
        'gambar',
        'syarat_ketentuan',
        'deadline_pendaftaran',
        'link_pendaftaran',
        'kontak_pic',
    ];

    protected $casts = [
        'deadline_pendaftaran' => 'date',
    ];

    /**
     * Satu kegiatan punya banyak baris nilai (per kriteria).
     */
    public function nilaiKegiatan()
    {
        return $this->hasMany(NilaiKegiatan::class);
    }

    /**
     * Satu kegiatan bisa masuk hasil SAW banyak user.
     */
    public function hasilSaw()
    {
        return $this->hasMany(HasilSaw::class);
    }

    public function hasilRekomendasi()
    {
        return $this->hasMany(HasilRekomendasi::class);
    }

    public function bookmarkUsers()
    {
        return $this->belongsToMany(User::class, 'bookmark_kegiatan')
            ->withTimestamps();
    }

    public function keikutsertaan()
    {
        return $this->hasMany(Keikutsertaan::class);
    }

    /**
     * Scope filter berdasarkan jenis kegiatan.
     * Contoh: Kegiatan::jenis('ukm')->get()
     */
    public function scopeJenis($query, $jenis)
    {
        return $query->where('jenis', $jenis);
    }
}