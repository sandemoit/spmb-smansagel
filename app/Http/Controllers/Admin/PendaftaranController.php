<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Nilai;
use App\Models\Berkas;
use App\Models\BerkasPersyaratan;
use Illuminate\Http\Request;
use DataTables;

class PendaftaranController extends Controller
{
    public function index()
    {
        $siswaList = Siswa::select(['id', 'nama_siswa', 'nisn', 'no_pendaftaran', 'status'])
            ->orderBy('id', 'desc')
            ->get();
        return view('admin.pendaftaran', compact('siswaList'));
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
}
