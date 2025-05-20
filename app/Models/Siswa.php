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
        'sekolah_asal',
        'tahun_lulus',
        'nik',
        'foto_3x4',
        'upload_kk',
        'jalur_pendaftaran_id',
        'nama_ayah',
        'nama_ibu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'penghasilan_ayah',
        'penghasilan_ibu',
        'longitude',
        'latitude',
        'jarak_kesekolah',
        'status',
        'no_pendaftaran',
        'user_id',
        'is_complete',
        'alamat'
    ];

    // Jika siswa terhubung dengan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }

    public function berkas()
    {
        return $this->hasMany(Berkas::class);
    }

    public function jalur_pendaftaran()
    {
        return $this->belongsTo(JalurPendaftaran::class);
    }

    public function isBiodataComplete()
    {
        foreach ($this->fillable as $field) {
            if (is_null($this->$field) || $this->$field === '') {
                return false;
            }
        }
        return true;
    }

    public function isNilaiComplete()
    {
        return Nilai::where('siswa_id', $this->id)->count() == 25;
    }

    public function isBerkasComplete()
    {
        $jumlahBerkasDibutuhkan = BerkasPersyaratan::where('jalur_pendaftaran_id', $this->jalur_pendaftaran_id)
            ->count();

        $jumlahBerkasSiswa = Berkas::where('siswa_id', $this->id)->count();

        return $jumlahBerkasSiswa >= $jumlahBerkasDibutuhkan;
    }

    public function isComplete()
    {
        return $this->isBiodataComplete() && $this->isBerkasComplete() && $this->isNilaiComplete();
    }

    public function checkAndUpdateCompleteStatus()
    {
        $isCompleteNow = $this->isComplete();
        if ($this->is_complete != $isCompleteNow) {
            $this->is_complete = $isCompleteNow;
            $this->status = 'pending';
            $this->save();
        }

        return $isCompleteNow;
    }
}
