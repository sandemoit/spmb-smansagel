<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\BerkasPersyaratan;
use App\Models\JalurPendaftaran;
use App\Models\Nilai;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    public function index() {}

    public function biodata()
    {
        $jalurs = JalurPendaftaran::get();
        $siswa = Siswa::where('user_id', Auth::user()->id)->firstOrFail();

        return view('page.pendaftaran.biodata', compact('siswa', 'jalurs'));
    }

    public function biodataUpdate(Request $request)
    {
        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();

        $validated = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'nisn' => 'required|string|max:20',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'sekolah_asal' => 'required|string|max:255',
            'tahun_lulus' => 'required|numeric',
            'nik' => 'required|string|max:30',
            'nama_ayah' => 'required|string',
            'nama_ibu' => 'required|string',
            'pekerjaan_ayah' => 'required|string',
            'pekerjaan_ibu' => 'required|string',
            'penghasilan_ayah' => 'required|string',
            'penghasilan_ibu' => 'required|string',
            'jalur_pendaftaran_id' => 'required|exists:jalur_pendaftaran,id',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'upload_kk' => 'nullable|file|mimes:jpg,jpeg,png',
            'foto_3x4' => 'nullable|file|mimes:jpg,jpeg,png',
            'jarak_kesekolah' => 'required|numeric',
            'alamat' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            // Simpan file jika ada
            if ($request->hasFile('upload_kk')) {
                $file = $request->file('upload_kk');
                $fileName = Str::slug($validated['nama_siswa'], '_') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('kk'), $fileName);
                $validated['upload_kk'] = "kk/$fileName";
            } else {
                $validated['upload_kk'] = 'Tidak wajib';
            }

            if ($request->hasFile('foto_3x4')) {
                $file = $request->file('foto_3x4');
                $fileName = Str::slug($validated['nama_siswa'], '_') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('foto'), $fileName);
                $validated['foto_3x4'] = "foto/$fileName";
            } else {
                $validated['foto_3x4'] = 'Tidak wajib';
            }

            $siswa->update($validated);

            DB::commit();
            if (in_array($siswa->jalur_pendaftaran_id, [5, 6])) {
                return redirect()->route('siswa.berkas')->with('success', 'Biodata berhasil diperbarui.');
            }
            return redirect()->route('siswa.nilai')->with('success', 'Biodata berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan. Biodata gagal diperbarui.');
        }
    }

    public function nilai()
    {
        $siswaId = Auth::user()->id; // atau pakai request()->siswa_id jika by URL param

        // Ambil semua nilai siswa dalam bentuk key => value
        $nilaiTersimpan = Nilai::where('siswa_id', $siswaId)->pluck('nilai', 'nama')->toArray();

        return view('page.pendaftaran.nilai', compact('nilaiTersimpan', 'siswaId'));
    }

    public function nilaiStore(Request $request)
    {
        $siswaId = Auth::user()->siswa->id; // asumsi relasi user → siswa

        $request->validate([
            'nilai' => 'required|array',
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->nilai as $nama => $nilai) {
                Nilai::updateOrCreate(
                    [
                        'siswa_id' => $siswaId,
                        'nama' => $nama,
                    ],
                    [
                        'nilai' => $nilai,
                        'semester' => (int) filter_var($nama, FILTER_SANITIZE_NUMBER_INT),
                    ]
                );
            }

            DB::commit();
            return redirect()->route('siswa.berkas')->with('success', 'Nilai berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan nilai.');
        }
    }

    public function berkas()
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->with('jalur_pendaftaran')->firstOrFail();

        $berkasPersyaratans = BerkasPersyaratan::where('jalur_pendaftaran_id', $siswa->jalur_pendaftaran_id)->get();

        // Ambil berkas yang sudah diupload siswa
        $berkasUploaded = Berkas::where('siswa_id', $siswa->id)->get()->keyBy('berkas_persyaratan_id');

        if ($siswa->is_complete) {
            return redirect()->route('dashboard')->with('success', 'Berkas berhasil diupload.');
        }

        return view('page.pendaftaran.berkas', compact('berkasPersyaratans', 'berkasUploaded', 'siswa'));
    }

    public function uploadBerkas(Request $request)
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->firstOrFail();

        $request->validate([
            'berkas.*' => 'file|mimes:pdf|max:2048', // Only PDF files, max 2MB
        ]);

        // Path ke folder berkas di public_html
        $publicRoot = base_path('../spmb.smanegeri1gelumbang.sch.id'); // Ganti 'username' sesuai nama user cPanel kamu
        $berkasPath = $publicRoot . '/berkas';

        try {
            DB::beginTransaction();

            if (!File::exists($berkasPath)) {
                File::makeDirectory($berkasPath, 0755, true);
            }

            foreach ($request->file('berkas', []) as $berkasPersyaratanId => $file) {
                if ($file) {
                    // Tambahkan ID atau timestamp biar nama file unik
                    $fileName = Str::slug($siswa->nama_siswa, '_') . '_' . $berkasPersyaratanId . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move($berkasPath, $fileName);
                    $path = "berkas/$fileName";

                    Berkas::updateOrCreate(
                        [
                            'siswa_id' => $siswa->id,
                            'berkas_persyaratan_id' => $berkasPersyaratanId,
                        ],
                        ['path_upload' => $path]
                    );
                }
            }

            $siswa->is_complete = $siswa->isComplete();
            $siswa->status = $siswa->is_complete ? 'pending' : 'tidak_lengkap';
            $siswa->save();

            DB::commit();

            return redirect()->back()->with('success', 'Berkas berhasil diupload.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengupload berkas.');
        }
    }

    public function lembarVerifikasi()
    {
        $user = Auth::user();
        $siswa = Siswa::where('user_id', $user->id)->with(['user', 'jalur_pendaftaran'])->firstOrFail();
        $nilais = Nilai::where('siswa_id', $siswa->id)->orderBy('id')->get();
        $jalur = $siswa->jalur_pendaftaran->nama;

        $pdf = Pdf::loadView('page.pendaftaran.lembar-verifikasi', compact('siswa', 'nilais', 'jalur'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('lembar_verifikasi_' . $siswa->nama . '.pdf');
    }
}
