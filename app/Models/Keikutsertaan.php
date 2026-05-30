<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keikutsertaan extends Model
{
    use HasFactory;

    protected $table = 'keikutsertaan';

    protected $fillable = [
        'user_id',
        'kegiatan_id',
        'status',
        'catatan',
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
