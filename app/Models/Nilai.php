<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $fillable = [
        'siswa_id',
        'nama',
        'nilai',
        'semester'
    ];
}
