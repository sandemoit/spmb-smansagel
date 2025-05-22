<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JalurPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'jalur_pendaftaran';

    protected $fillable = [
        'nama',
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function berkas_persyaratan()
    {
        return $this->hasMany(BerkasPersyaratan::class);
    }
}
