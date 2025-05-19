<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'nama_siswa',
        'nisn',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'no_hp',
        'email',
        'sekolah_asal',
        'tahun_lulus',
        'nik_kk',
        'foto_3x4',
        'upload_kk',
        'nama_jalur_pendaftaran',
        'nama_ayah',
        'nama_ibu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'penghasilan_ayah',
        'penghasilan_ibu',
    ];

    // Jika siswa terhubung dengan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isComplete()
    {
        foreach ($this->fillable as $field) {
            if (is_null($this->$field) || $this->$field === '') {
                return false;
            }
        }
        return true;
    }
}
