<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    protected $primaryKey = 'NIP';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'NIP',
        'user_id',
        'Nama',
        'Alamat',
        'Nohp',
    ];

    /**
     * Get the user that owns the dosen.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the pengampu records for the dosen.
     */
    public function pengampu()
    {
        return $this->hasMany(Pengampu::class, 'NIP', 'NIP');
    }

    /**
     * Get the matakuliah through pengampu.
     */
    public function matakuliah()
    {
        return $this->belongsToMany(Matakuliah::class, 'pengampu', 'NIP', 'Kode_mk');
    }
}
