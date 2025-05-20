<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Nilai;
use App\Models\Berkas;
use App\Models\BerkasPersyaratan;
use App\Models\JalurPendaftaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use DataTables;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua jalur pendaftaran untuk filter
        $jalurList = JalurPendaftaran::all();

        // Query dasar
        $query = Siswa::with('jalur_pendaftaran')
            ->select(['id', 'nama_siswa', 'nisn', 'no_pendaftaran', 'status', 'jalur_pendaftaran_id', 'user_id'])
            ->whereHas('user', function ($query) {
                $query->where('role', 'siswa');
            });

        // Filter berdasarkan jalur pendaftaran jika parameter ada
        if ($request->has('jalur') && $request->jalur) {
            $query->where('jalur_pendaftaran_id', $request->jalur);
        }

        // Dapatkan data siswa
        $siswaList = $query->orderBy('id', 'desc')->get();

        return view('admin.pendaftaran', compact('siswaList', 'jalurList'));
    }

    public function show($id)
    {
        $siswa = Siswa::with(['nilai', 'berkas', 'jalur_pendaftaran'])->findOrFail($id);

        // ambil semua berkas persyaratan berdasarkan jalur pendaftaran siswa
        $berkasPersyaratan = \App\Models\BerkasPersyaratan::where('jalur_pendaftaran_id', $siswa->jalur_pendaftaran_id)->get();
        // jadikan berkas siswa keyed by berkas_persyaratan_id
        $berkasUploaded = $siswa->berkas->keyBy('berkas_persyaratan_id');

        // Kelompokkan nilai berdasarkan semester
        $nilaiPerSemester = $siswa->nilai->groupBy('semester');

        return view('admin.pendaftaran-show', compact('siswa', 'berkasPersyaratan', 'berkasUploaded', 'nilaiPerSemester'));
    }

    public function destroy($id)
    {
        try {
            $siswa = Siswa::findOrFail($id);

            // Hapus nilai terkait
            $siswa->nilai()->delete();

            // Hapus berkas terkait
            $siswa->berkas()->delete();

            // Hapus user
            $siswa->user()->delete();

            // Hapus siswa
            $siswa->delete();

            return redirect()->back()->with('success', 'Data siswa berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak,verifikasi,tidak_lengkap'
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->status = $request->status;
        $siswa->save();

        return redirect()->back()->with('success', 'Status pendaftaran berhasil diperbarui');
    }

    public function lembarVerifikasi($no_pendaftaran)
    {
        $siswa = Siswa::where('no_pendaftaran', $no_pendaftaran)
            ->with(['user', 'jalur_pendaftaran'])
            ->firstOrFail();

        $nilais = Nilai::where('siswa_id', $siswa->id)->orderBy('id')->get();
        $jalur = $siswa->jalur_pendaftaran->nama;

        $pdf = Pdf::loadView('page.pendaftaran.lembar-verifikasi', compact('siswa', 'nilais', 'jalur'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('lembar_verifikasi_' . $siswa->nama_siswa . '.pdf');
    }
}
