<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilSaw extends Model
{
    use HasFactory;

    protected $table = 'hasil_saw';

    protected $fillable = [
        'user_id',
        'kegiatan_id',
        'skor',
        'ranking',
        'input_preferensi',
    ];

    protected $casts = [
        'skor'             => 'float',
        'input_preferensi' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}