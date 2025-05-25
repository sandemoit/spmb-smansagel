<?php

namespace App\Exports;

use App\Models\Siswa;
use App\Models\Nilai;
use App\Models\Berkas;
use App\Models\JalurPendaftaran;
use App\Models\BerkasPersyaratan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\URL;

class SiswaExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $jalur;
    protected $status;
    protected $columns;
    protected $headings = [];
    protected $mapelColumns = [];
    protected $berkasColumns = [];
    protected $jalurId = null;

    public function __construct($jalur, $status, $columns)
    {
        $this->jalur = $jalur;
        $this->status = $status;
        $this->columns = $columns;

        // Jika jalur specific, dapatkan ID jalur
        if ($jalur != 'semua') {
            $this->jalurId = $jalur; // Sudah berupa ID
        }

        // Mengatur headings berdasarkan kolom yang dipilih
        $this->prepareHeadings();
    }

    /**
     * Persiapkan data heading dan mapping kolom
     */
    private function prepareHeadings()
    {
        // Menyiapkan heading dasar siswa
        $columnMappings = [
            'nama_siswa' => 'Nama Siswa',
            'nisn' => 'NISN',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'jenis_kelamin' => 'Jenis Kelamin',
            'agama' => 'Agama',
            'no_hp' => 'No. HP',
            'sekolah_asal' => 'Sekolah Asal',
            'tahun_lulus' => 'Tahun Lulus',
            'nik' => 'NIK',
            'jalur' => 'Jalur Pendaftaran',
            'nama_ayah' => 'Nama Ayah',
            'nama_ibu' => 'Nama Ibu',
            'pekerjaan_ayah' => 'Pekerjaan Ayah',
            'pekerjaan_ibu' => 'Pekerjaan Ibu',
            'penghasilan_ayah' => 'Penghasilan Ayah',
            'penghasilan_ibu' => 'Penghasilan Ibu',
            'status' => 'Status',
            'alamat' => 'Alamat'
        ];

        // Tambahkan heading untuk kolom yang dipilih
        foreach ($this->columns as $column) {
            // Cek jika kolom adalah kolom dasar siswa
            if (isset($columnMappings[$column])) {
                $this->headings[$column] = $columnMappings[$column];
            }
            // Cek jika kolom adalah nilai mata pelajaran dengan semester
            elseif (strpos($column, 'nilai_') === 0) {
                $parts = explode('_', substr($column, 6)); // Hapus 'nilai_' dari awal
                if (count($parts) >= 2) {
                    $semester = array_pop($parts); // Ambil semester dari bagian terakhir
                    $mapelName = implode(' ', array_map('ucfirst', $parts)); // Gabungkan dan kapitalisasi nama mapel

                    $this->headings[$column] = 'Nilai ' . $mapelName . ' Semester ' . $semester;
                } else {
                    $this->headings[$column] = 'Nilai ' . ucfirst(substr($column, 6));
                }
            }
            // Cek jika kolom adalah berkas
            elseif (strpos($column, 'berkas_') === 0) {
                $berkasId = substr($column, 7); // Ambil ID berkas
                $berkasPersyaratan = BerkasPersyaratan::find($berkasId);
                if ($berkasPersyaratan) {
                    $this->berkasColumns[$berkasId] = $berkasPersyaratan->nama_berkas;
                    $this->headings[$column] = 'Berkas ' . $berkasPersyaratan->nama_berkas;
                }
            }
        }
    }

    /**
     * Data siswa yang akan diekspor
     */
    public function collection()
    {
        $query = Siswa::with(['nilai', 'berkas.berkas_persyaratan', 'jalur_pendaftaran', 'user']);

        // Filter berdasarkan jalur
        if ($this->jalur != 'semua') {
            $query->where('jalur_pendaftaran_id', $this->jalur);
        }

        // Filter berdasarkan status
        if ($this->status != 'semua') {
            switch ($this->status) {
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

        return $query->get();
    }

    /**
     * Heading untuk file ekspor
     */
    public function headings(): array
    {
        return array_values($this->headings);
    }

    /**
     * Mapping data untuk setiap baris
     */
    public function map($siswa): array
    {
        $row = [];
        $baseUrl = URL::to('/');

        foreach (array_keys($this->headings) as $column) {
            // Kolom dasar siswa
            if (in_array($column, ['nama_siswa', 'nisn', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'no_hp', 'sekolah_asal', 'tahun_lulus', 'nik', 'nama_ayah', 'nama_ibu', 'pekerjaan_ayah', 'pekerjaan_ibu', 'penghasilan_ayah', 'penghasilan_ibu', 'alamat'])) {
                $row[] = $siswa->$column ?? '-';
            }
            // Jalur pendaftaran
            elseif ($column == 'jalur') {
                $row[] = $siswa->jalur_pendaftaran ? $siswa->jalur_pendaftaran->nama : '-';
            }
            // Status
            elseif ($column == 'status') {
                $row[] = $siswa->status ?? '-';
            }
            // Nilai mata pelajaran dengan semester
            elseif (strpos($column, 'nilai_') === 0) {
                $parts = explode('_', substr($column, 6)); // Hapus 'nilai_' dari awal
                if (count($parts) >= 2) {
                    $semester = array_pop($parts); // Ambil semester dari bagian terakhir
                    $mapelName = implode('_', $parts); // Gabungkan kembali nama mapel

                    $nilaiObj = $siswa->nilai->where('nama', $mapelName)->where('semester', $semester)->first();
                    $row[] = $nilaiObj ? $nilaiObj->nilai : '-';
                } else {
                    // Fallback jika format tidak sesuai
                    $row[] = '-';
                }
            }
            // Berkas persyaratan
            elseif (strpos($column, 'berkas_') === 0) {
                $berkasId = substr($column, 7); // Ambil ID berkas
                $berkasObj = $siswa->berkas->where('berkas_persyaratan_id', $berkasId)->first();
                if ($berkasObj && $berkasObj->path_upload) {
                    $row[] = $baseUrl . '/' . $berkasObj->path_upload;
                } else {
                    $row[] = '-';
                }
            }
        }

        return $row;
    }

    /**
     * Styling untuk Excel
     */
    public function styles(Worksheet $sheet)
    {
        // Style untuk header
        $sheet->getStyle('1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4F81BD'],
            ],
        ]);

        // Menerapkan style untuk seluruh sheet
        $lastColumn = $sheet->getHighestColumn();
        $lastRow = $sheet->getHighestRow();

        // Border untuk seluruh data
        $sheet->getStyle('A1:' . $lastColumn . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // Wrap text untuk konten yang panjang
        $sheet->getStyle('A1:' . $lastColumn . $lastRow)->getAlignment()->setWrapText(true);

        return $sheet;
    }
}
