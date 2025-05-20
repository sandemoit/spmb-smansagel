<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    protected $table = 'berkas';
    protected $fillable = [

        'siswa_id',
        'berkas_persyaratan_id',
        'path_upload'
    ];
}
