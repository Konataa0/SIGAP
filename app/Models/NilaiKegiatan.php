<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiKegiatan extends Model
{
    use HasFactory;

    protected $table = 'nilai_kegiatan';

    protected $fillable = [
        'kegiatan_id',
        'kriteria_id',
        'nilai',
    ];

    protected $casts = [
        'nilai' => 'float',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}