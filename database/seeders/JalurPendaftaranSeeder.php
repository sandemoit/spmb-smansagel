<?php

namespace Database\Seeders;

use App\Models\JalurPendaftaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JalurPendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jalur = [
            'Domisili',
            'Afirmasi',
            'Prestasi Akademik',
            'Prestasi Non Akademik',
            'Mutasi',
        ];

        foreach ($jalur as $nama) {
            JalurPendaftaran::create(['nama' => $nama]);
        }
    }
}
