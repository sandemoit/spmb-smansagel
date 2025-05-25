<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JalurPendaftaran;
use Illuminate\Http\Request;
use App\Models\Siswa;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total siswa
        $totalSiswa = Siswa::whereHas('user', function ($query) {
            $query->where('role', 'siswa');
        })->count();

        // Hitung siswa dengan status pending
        $pendingSiswa = Siswa::whereHas('user', function ($query) {
            $query->where('role', 'siswa');
        })->where('status', 'pending')->count();

        // Hitung siswa dengan status verifikasi
        $verifikasiSiswa = Siswa::whereHas('user', function ($query) {
            $query->where('role', 'siswa');
        })->where('status', 'verifikasi')->count();

        // Hitung siswa tidak lengkap (is_complete = 0)
        $tidakLengkapSiswa = Siswa::whereHas('user', function ($query) {
            $query->where('role', 'siswa');
        })->where('status', 'tidak_lengkap')->count();

        // Hitung total siswa per jalur pendaftaran
        $jalurPendaftaran = JalurPendaftaran::select('jalur_pendaftaran.id', 'jalur_pendaftaran.nama')
            ->selectRaw('COUNT(siswa.id) as total')
            ->leftJoin('siswa', 'jalur_pendaftaran.id', '=', 'siswa.jalur_pendaftaran_id')
            ->leftJoin('users', 'siswa.user_id', '=', 'users.id')
            ->where('users.role', 'siswa')
            ->groupBy('jalur_pendaftaran.id', 'jalur_pendaftaran.nama')
            ->get();

        return view('admin.dashboard', compact(
            'totalSiswa',
            'pendingSiswa',
            'verifikasiSiswa',
            'tidakLengkapSiswa',
            'jalurPendaftaran'
        ));
    }
}
