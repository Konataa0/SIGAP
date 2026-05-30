<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\HasilRekomendasi;
use App\Models\Keikutsertaan;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nim',
        'jurusan',
        'angkatan',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    /**
     * Cek apakah user adalah Admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user adalah Mahasiswa.
     */
    public function isMahasiswa(): bool
    {
        return $this->role === 'mahasiswa';
    }

    /**
     * Satu user punya banyak hasil SAW.
     */
    public function hasilSaw()
    {
        return $this->hasMany(HasilSaw::class);
    }

    /**
     * Ambil hasil SAW terakhir user ini, sudah diurutkan ranking.
     */
    public function rekomendasiTerakhir()
    {
        return $this->hasMany(HasilRekomendasi::class)
                    ->latest();
    }

    public function hasilRekomendasi()
    {
        return $this->hasMany(HasilRekomendasi::class);
    }

    public function bookmarkKegiatan()
    {
        return $this->belongsToMany(Kegiatan::class, 'bookmark_kegiatan')
            ->withTimestamps();
    }

    public function keikutsertaan()
    {
        return $this->hasMany(Keikutsertaan::class);
    }
}