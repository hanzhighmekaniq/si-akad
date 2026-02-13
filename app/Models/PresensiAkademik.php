<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiAkademik extends Model
{
    use HasFactory;

    protected $table = 'presensi_akademik';

    protected $fillable = [
        'hari',
        'tanggal',
        'status_kehadiran',
        'NIM',
        'Kode_mk',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Get the mahasiswa that owns the presensi.
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'NIM', 'NIM');
    }

    /**
     * Get the matakuliah that owns the presensi.
     */
    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'Kode_mk', 'Kode_mk');
    }
}
