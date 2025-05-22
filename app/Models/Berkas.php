<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use HasFactory;

    protected $table = 'berkas';

    protected $fillable = [
        'siswa_id',
        'berkas_persyaratan_id',
        'path_upload'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function berkas_persyaratan()
    {
        return $this->belongsTo(BerkasPersyaratan::class);
    }
}
