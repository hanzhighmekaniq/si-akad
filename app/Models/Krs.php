<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    use HasFactory;

    protected $table = 'krs';
    public $incrementing = false;

    protected $fillable = [
        'NIM',
        'Kode_mk',
    ];

    /**
     * Get the mahasiswa that owns the KRS.
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'NIM', 'NIM');
    }

    /**
     * Get the matakuliah that owns the KRS.
     */
    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'Kode_mk', 'Kode_mk');
    }
}
