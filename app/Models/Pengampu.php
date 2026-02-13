<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengampu extends Model
{
    use HasFactory;

    protected $table = 'pengampu';
    public $incrementing = false;

    protected $fillable = [
        'Kode_mk',
        'NIP',
    ];

    /**
     * Get the dosen that owns the pengampu.
     */
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'NIP', 'NIP');
    }

    /**
     * Get the matakuliah that owns the pengampu.
     */
    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'Kode_mk', 'Kode_mk');
    }
}
