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
            $jalur = JalurPendaftaran::find($jalurId);
            if ($jalur) {
                // Get berkas specific to this jalur and any default berkas
                $berkas = BerkasPersyaratan::where('jalur_pendaftaran_id', $jalur->id)
                    ->orWhereNull('jalur_pendaftaran_id')
                    ->get();
            } else {
                $berkas = BerkasPersyaratan::whereNull('jalur_pendaftaran_id')->get();
            }
        }

        return response()->json($berkas);
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

        // Query dasar dengan relasi yang diperlukan
        $query = Siswa::with(['nilai', 'berkas.berkas_persyaratan', 'jalur_pendaftaran', 'user']);

        // Filter berdasarkan jalur
        if ($jalur != 'semua') {
            $query->where('jalur_pendaftaran_id', $jalur);
        }

        // Filter berdasarkan status
        if ($status != 'semua') {
            switch ($status) {
                case 'tidak_lengkap':
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
            $jalurSelected = null;

            // Get the berkas persyaratan for the selected jalur
            if ($jalur != 'semua') {
                $jalurObj = JalurPendaftaran::find($jalur);
                $jalurSelected = $jalurObj ? $jalurObj->nama : null;
                $berkas = $jalurObj ?
                    BerkasPersyaratan::where('jalur_pendaftaran_id', $jalurObj->id)
                    ->orWhereNull('jalur_pendaftaran_id')
                    ->get() :
                    BerkasPersyaratan::whereNull('jalur_pendaftaran_id')->get();
            } else {
                $berkas = BerkasPersyaratan::all();
            }

            return view('admin.export.index', compact('preview', 'columns', 'total', 'jalurList', 'jalurSelected', 'status', 'berkas'));
        }

        // Untuk download, proses export
        $filename = 'data_siswa_' . date('Y-m-d_His');

        // Export berdasarkan format yang dipilih
        switch ($format) {
            case 'excel':
                return Excel::download(new SiswaExport($jalur, $status, $columns), $filename . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
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
                    $row[$column] = $s->$column ?? '-';
                }
                // Jalur pendaftaran
                elseif ($column == 'jalur') {
                    $row[$column] = $s->jalur_pendaftaran ? $s->jalur_pendaftaran->nama : '-';
                }
                // Status
                elseif ($column == 'status') {
                    $row[$column] = $s->status ?? '-';
                }
                // Nilai dengan format nama_semester (contoh: matematika_1, ipa_2)
                elseif (strpos($column, 'nilai_') === 0) {
                    $parts = explode('_', substr($column, 6)); // Hapus 'nilai_' dari awal
                    if (count($parts) >= 2) {
                        $semester = array_pop($parts); // Ambil semester dari bagian terakhir
                        $mapelName = implode('_', $parts); // Gabungkan kembali nama mapel

                        $nilaiObj = $s->nilai->where('nama', $mapelName)->where('semester', $semester)->first();
                        $row[$column] = $nilaiObj ? $nilaiObj->nilai : '-';
                    } else {
                        // Fallback jika format tidak sesuai
                        $row[$column] = '-';
                    }
                }
                // Berkas
                elseif (strpos($column, 'berkas_') === 0) {
                    $berkasId = substr($column, 7); // Ambil id berkas (setelah 'berkas_')
                    $berkasObj = $s->berkas->where('berkas_persyaratan_id', $berkasId)->first();
                    if ($berkasObj && $berkasObj->path_upload) {
                        $row[$column] = $baseUrl . '/storage/' . $berkasObj->path_upload;
                    } else {
                        $row[$column] = '-';
                    }
                }
            }

            $preview[] = $row;
        }

        return $preview;
    }

    public function getByJalur($id)
    {
        $berkas = BerkasPersyaratan::where('jalur_pendaftaran_id', $id)
            ->orWhereNull('jalur_pendaftaran_id')
            ->get(['id', 'nama_berkas']);
        return response()->json($berkas);
    }
}
