<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalAkademik extends Model
{
    use HasFactory;

    protected $table = 'jadwal_akademik';

    protected $fillable = [
        'hari',
        'jam_mulai',
        'jam_selesai',
        'Kode_mk',
        'id_ruang',
        'id_Gol',
    ];

    /**
     * Get the matakuliah that owns the jadwal.
     */
    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'Kode_mk', 'Kode_mk');
    }

    /**
     * Get the ruang that owns the jadwal.
     */
    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'id_ruang', 'id_ruang');
    }

    /**
     * Get the golongan that owns the jadwal.
     */
    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'id_Gol', 'id_Gol');
    }
}
