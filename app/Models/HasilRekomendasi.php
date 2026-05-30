<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilRekomendasi extends Model
{
    use HasFactory;

    protected $table = 'hasil_rekomendasi';

    protected $fillable = [
        'user_id',
        'preferensi',
        'hasil_detail',
        'top_tiga',
    ];

    protected $casts = [
        'preferensi' => 'array',
        'hasil_detail' => 'array',
        'top_tiga' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
