<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total siswa
        $totalSiswa = Siswa::count();

        // Hitung siswa dengan status pending
        $pendingSiswa = Siswa::where('status', 'pending')->count();

        // Hitung siswa dengan status verifikasi
        $verifikasiSiswa = Siswa::where('status', 'verifikasi')->count();

        // Hitung siswa tidak lengkap (is_complete = 0)
        $tidakLengkapSiswa = Siswa::where('status', 'tidak_lengkap')->count();

        return view('admin.dashboard', compact(
            'totalSiswa',
            'pendingSiswa',
            'verifikasiSiswa',
            'tidakLengkapSiswa',
            'totalJalurDomisili',
            'totalJalurAfirmasi',
            'totalJalurPrestasiAkademik',
            'totalJalurPrestasiNonAkademik',
            'totalJalurMutasi',
        ));
    }
}
