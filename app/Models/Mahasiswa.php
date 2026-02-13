<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'NIM';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'NIM',
        'user_id',
        'Nama',
        'Alamat',
        'Nohp',
        'Semester',
        'id_Gol',
    ];

    /**
     * Get the user that owns the mahasiswa.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the golongan that the mahasiswa belongs to.
     */
    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'id_Gol', 'id_Gol');
    }

    /**
     * Get the KRS records for the mahasiswa.
     */
    public function krs()
    {
        return $this->hasMany(Krs::class, 'NIM', 'NIM');
    }

    /**
     * Get the matakuliah through KRS.
     */
    public function matakuliah()
    {
        return $this->belongsToMany(Matakuliah::class, 'krs', 'NIM', 'Kode_mk');
    }

    /**
     * Get the presensi records for the mahasiswa.
     */
    public function presensi()
    {
        return $this->hasMany(PresensiAkademik::class, 'NIM', 'NIM');
    }
}
