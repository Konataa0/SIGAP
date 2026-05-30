<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookmarkKegiatan extends Model
{
    use HasFactory;

    protected $table = 'bookmark_kegiatan';

    protected $fillable = [
        'user_id',
        'kegiatan_id',
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
