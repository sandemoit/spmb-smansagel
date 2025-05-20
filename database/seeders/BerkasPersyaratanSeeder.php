<?php

namespace Database\Seeders;

use App\Models\BerkasPersyaratan;
use App\Models\JalurPendaftaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BerkasPersyaratanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $berkasData = [
            'Domisili' => [
                ['IJAZAH/SURAT KETERANGAN', true],
                ['KARTU KELUARGA', true],
                ['AKTE KELAHIRAN', true],
                ['PERNYATAAN ORANG TUA DI ATAS MATERAI', true],
                ['SPTJM NILAI RAPOR', true],
            ],
            'Afirmasi' => [
                ['IJAZAH/SURAT KETERANGAN', true],
                ['KARTU KELUARGA', true],
                ['AKTE KELAHIRAN', true],
                ['PERNYATAAN ORANG TUA DI ATAS MATERAI', true],
                ['PIP/PKH/SUKET DOKTER BAGI DISABILITAS', true],
            ],
            'Prestasi Akademik' => [
                ['IJAZAH/SURAT KETERANGAN', true],
                ['KARTU KELUARGA', true],
                ['AKTE KELAHIRAN', true],
                ['PERNYATAAN ORANG TUA DI ATAS MATERAI', true],
                ['SPTJM NILAI RAPOR', true],
                ['SPTJM RANKING/PERINGKAT', true],
                ['SPTJM PRESTASI AKADEMIK', true],
            ],
            'Prestasi Non Akademik' => [
                ['IJAZAH/SURAT KETERANGAN', true],
                ['KARTU KELUARGA', true],
                ['AKTE KELAHIRAN', true],
                ['PERNYATAAN ORANG TUA DI ATAS MATERAI', true],
                ['SPTJM NILAI RAPOR', true],
                ['SPTJM PRESTASI NON-AKADEMI', true],
                ['SPTJM PENGALAMAN ORGANISASI KESISWAAN', true],
            ],
            'Mutasi' => [
                ['IJAZAH/SURAT KETERANGAN', true],
                ['SURAT KETERANGAN DOMISILI', true],
                ['AKTE KELAHIRAN', true],
                ['PERNYATAAN ORANG TUA DIATAS MATERAI', true],
                ['SURAT PINDAH TUGAS DARI PIMPINAN INSTASI/LEMBAGA/TNI/POLRI/PERUSAHAN (BUMN/BUMD) YANG MEMPERKERJAAN ORANGTUA', true],
                ['SURAT PENUGASAN (BAGI ANAK GURU)', false],
                ['KARTU KELUARGA (BAGI ANAK GURU)', false],
            ]
        ];

        foreach ($berkasData as $jalur => $berkasList) {
            $jalurModel = JalurPendaftaran::where('nama', $jalur)->first();
            foreach ($berkasList as [$namaBerkas, $isRequired]) {
                BerkasPersyaratan::create([
                    'jalur_pendaftaran_id' => $jalurModel->id,
                    'nama_berkas' => $namaBerkas,
                    'is_required' => $isRequired,
                ]);
            }
        }
    }
}
