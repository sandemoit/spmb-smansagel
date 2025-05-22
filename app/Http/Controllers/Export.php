<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\JalurPendaftaran;
use App\Models\BerkasPersyaratan;
use App\Exports\SiswaExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\URL;

class Export extends Controller
{
    public function index()
    {
        $jalurList = JalurPendaftaran::all();
        $defaultBerkas = BerkasPersyaratan::whereNull('jalur_pendaftaran_id')->get();

        return view('admin.export.index', compact('jalurList', 'defaultBerkas'));
    }

    public function getBerkasByJalur(Request $request)
    {
        $jalurId = $request->jalur_id;

        // Get berkas for specific jalur and default berkas (if any)
        if ($jalurId == 'semua') {
            // If "semua" is selected, get all unique berkas across all jalur
            $berkas = BerkasPersyaratan::all();
        } else {
            $jalur = JalurPendaftaran::where('nama', $jalurId)->first();
            if ($jalur) {
                // Get berkas specific to this jalur and any default berkas
                $berkas = BerkasPersyaratan::where('jalur_pendaftaran_id', $jalur->id)
                    ->orWhereNull('jalur_pendaftaran_id')
                    ->get();
            } else {
                $berkas = BerkasPersyaratan::whereNull('jalur_pendaftaran_id')->get();
            }
        }

        return response()->json(['berkas' => $berkas]);
    }

    public function exportSiswa(Request $request)
    {
        $request->validate([
            'jalur' => 'required',
            'status' => 'required',
            'format' => 'required|in:excel,pdf,csv',
            'columns' => 'required|array',
        ]);

        $jalur = $request->jalur;
        $status = $request->status;
        $format = $request->format;
        $columns = $request->columns;
        $action = $request->action;

        // Query dasar
        $query = Siswa::with(['nilai', 'berkas', 'jalur_pendaftaran', 'user'])
            ->select('siswa.*');

        // Filter berdasarkan jalur
        if ($jalur != 'semua') {
            $query->whereHas('jalur_pendaftaran', function ($q) use ($jalur) {
                $q->where('nama', $jalur);
            });
        }

        // Filter berdasarkan status
        if ($status != 'semua') {
            switch ($status) {
                case 'belum_lengkap':
                    $query->where('is_complete', false);
                    break;
                case 'verifikasi':
                    $query->where('status', 'Verifikasi');
                    break;
                case 'pending':
                    $query->where('status', 'Pending');
                    break;
                case 'diterima':
                    $query->where('status', 'Diterima');
                    break;
                case 'tidak_lolos':
                    $query->where('status', 'Tidak Lolos');
                    break;
            }
        }

        // Jika preview, ambil hanya 10 data
        if ($action == 'preview') {
            $siswa = $query->take(10)->get();
            $total = $query->count();

            // Format data untuk preview
            $preview = $this->formatDataForPreview($siswa, $columns);

            // Kembalikan view dengan data preview
            $jalurList = JalurPendaftaran::all();

            // Get the berkas persyaratan for the selected jalur
            if ($jalur != 'semua') {
                $jalurObj = JalurPendaftaran::where('nama', $jalur)->first();
                $berkas = $jalurObj ?
                    BerkasPersyaratan::where('jalur_pendaftaran_id', $jalurObj->id)
                    ->orWhereNull('jalur_pendaftaran_id')
                    ->get() :
                    BerkasPersyaratan::whereNull('jalur_pendaftaran_id')->get();
            } else {
                $berkas = BerkasPersyaratan::all();
            }

            return view('admin.export.index', compact('preview', 'columns', 'total', 'jalurList', 'jalur', 'status', 'berkas'));
        }

        // Untuk download, proses export
        $filename = 'data_siswa_' . date('Y-m-d_His');

        // Export berdasarkan format yang dipilih
        switch ($format) {
            case 'excel':
                return Excel::download(new SiswaExport($jalur, $status, $columns), $filename . '.xlsx');
            case 'csv':
                return Excel::download(new SiswaExport($jalur, $status, $columns), $filename . '.csv', \Maatwebsite\Excel\Excel::CSV);
            case 'pdf':
                return Excel::download(new SiswaExport($jalur, $status, $columns), $filename . '.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
        }
    }

    private function formatDataForPreview($siswa, $columns)
    {
        $preview = [];
        $baseUrl = URL::to('/');

        foreach ($siswa as $s) {
            $row = [];

            // Proses data siswa sesuai kolom yang dipilih
            foreach ($columns as $column) {
                // Kolom dasar siswa
                if (in_array($column, ['nama_siswa', 'nisn', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'no_hp', 'sekolah_asal', 'tahun_lulus', 'nik', 'foto_3x4', 'nama_ayah', 'nama_ibu', 'pekerjaan_ayah', 'pekerjaan_ibu', 'penghasilan_ayah', 'penghasilan_ibu', 'alamat'])) {
                    $row[$column] = $s->$column;
                }
                // Jalur pendaftaran
                elseif ($column == 'jalur') {
                    $row[$column] = $s->jalur_pendaftaran ? $s->jalur_pendaftaran->nama : '-';
                }
                // Status
                elseif ($column == 'status') {
                    $row[$column] = $s->status;
                }
                // Nilai
                elseif (strpos($column, 'nilai_') === 0) {
                    $mapelName = substr($column, 6); // Ambil nama mapel (setelah 'nilai_')
                    $nilaiObj = $s->nilai->where('nama', $mapelName)->first();
                    $row[$column] = $nilaiObj ? $nilaiObj->nilai : '-';
                }
                // Berkas
                elseif (strpos($column, 'berkas_') === 0) {
                    $berkasId = substr($column, 7); // Ambil id berkas (setelah 'berkas_')
                    $berkasObj = $s->berkas->where('berkas_persyaratan_id', $berkasId)->first();
                    $row[$column] = $berkasObj ? $baseUrl . $berkasObj->path_upload : '-';
                }
            }

            $preview[] = $row;
        }

        return $preview;
    }

    public function getByJalur($id)
    {
        // Bisa juga include data berkas secara lengkap
        $berkas = BerkasPersyaratan::where('jalur_pendaftaran_id', $id)->get(['id']);
        return response()->json($berkas);
    }
}
