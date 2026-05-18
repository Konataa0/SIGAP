<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bobot extends Model
{
    use HasFactory;

    protected $table = 'bobot';

    protected $fillable = [
        'kriteria_id',
        'nilai',
    ];

    protected $casts = [
        'nilai' => 'float',
    ];

    /**
     * Bobot ini milik satu kriteria.
     */
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}