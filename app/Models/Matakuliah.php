<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    protected $table = 'matakuliah';
    protected $primaryKey = 'Kode_mk';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'Kode_mk',
        'Nama_mk',
        'sks',
        'semester',
    ];

    /**
     * Get the pengampu records for the matakuliah.
     */
    public function pengampu()
    {
        return $this->hasMany(Pengampu::class, 'Kode_mk', 'Kode_mk');
    }

    /**
     * Get the dosen through pengampu.
     */
    public function dosen()
    {
        return $this->belongsToMany(Dosen::class, 'pengampu', 'Kode_mk', 'NIP');
    }

    /**
     * Get the KRS records for the matakuliah.
     */
    public function krs()
    {
        return $this->hasMany(Krs::class, 'Kode_mk', 'Kode_mk');
    }

    /**
     * Get the mahasiswa through KRS.
     */
    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'krs', 'Kode_mk', 'NIM');
    }

    /**
     * Get the jadwal akademik for the matakuliah.
     */
    public function jadwalAkademik()
    {
        return $this->hasMany(JadwalAkademik::class, 'Kode_mk', 'Kode_mk');
    }

    /**
     * Get the presensi records for the matakuliah.
     */
    public function presensi()
    {
        return $this->hasMany(PresensiAkademik::class, 'Kode_mk', 'Kode_mk');
    }
}
