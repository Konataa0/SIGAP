<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriteria';

    protected $fillable = [
        'nama',
        'kode',
        'jenis',
        'keterangan',
    ];

    /**
     * Satu kriteria punya satu bobot.
     */
    public function bobot()
    {
        return $this->hasOne(Bobot::class);
    }

    /**
     * Satu kriteria punya banyak nilai kegiatan.
     */
    public function nilaiKegiatan()
    {
        return $this->hasMany(NilaiKegiatan::class);
    }
}