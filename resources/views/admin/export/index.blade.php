<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Export Data Siswa
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Pilihan Export Data</h3>

                    <form action="{{ route('export.action') }}" method="GET" class="space-y-6">
                        @csrf

                        <!-- Filter Jalur -->
                        <div class="space-y-2">
                            <label for="jalur" class="block text-sm font-medium text-gray-700">
                                Berdasarkan Jalur
                            </label>
                            <select id="jalur-select" name="jalur"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="semua">Semua Jalur</option>
                                @foreach ($jalurList as $j)
                                    <option value="{{ $j->id }}"
                                        {{ isset($jalurSelected) && $jalurSelected == $j->nama ? 'selected' : '' }}>
                                        {{ $j->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filter Status -->
                        <div class="space-y-2">
                            <label for="status" class="block text-sm font-medium text-gray-700">
                                Berdasarkan Status
                            </label>
                            <select id="status" name="status"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="semua"
                                    {{ isset($statusSelected) && $statusSelected == 'semua' ? 'selected' : '' }}>Semua
                                </option>
                                <option value="tidak_lengkap"
                                    {{ isset($statusSelected) && $statusSelected == 'tidak_lengkap' ? 'selected' : '' }}>
                                    Belum Lengkap</option>
                                <option value="verifikasi"
                                    {{ isset($statusSelected) && $statusSelected == 'verifikasi' ? 'selected' : '' }}>
                                    Verifikasi</option>
                                <option value="pending"
                                    {{ isset($statusSelected) && $statusSelected == 'pending' ? 'selected' : '' }}>
                                    Pending</option>
                                <option value="diterima"
                                    {{ isset($statusSelected) && $statusSelected == 'diterima' ? 'selected' : '' }}>
                                    Diterima</option>
                                <option value="tidak_lolos"
                                    {{ isset($statusSelected) && $statusSelected == 'tidak_lolos' ? 'selected' : '' }}>
                                    Tidak Lolos</option>
                            </select>
                        </div>

                        <!-- Format Export -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Format Export</label>
                            <div class="mt-2 space-x-4 flex items-center">
                                <div class="flex items-center">
                                    <input id="format_excel" name="format" type="radio" value="excel" checked
                                        class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                    <label for="format_excel" class="ml-2 block text-sm text-gray-700">
                                        Excel (.xlsx)
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input id="format_pdf" name="format" type="radio" value="pdf"
                                        class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                    <label for="format_pdf" class="ml-2 block text-sm text-gray-700">
                                        PDF
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input id="format_csv" name="format" type="radio" value="csv"
                                        class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                    <label for="format_csv" class="ml-2 block text-sm text-gray-700">
                                        CSV
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Pilihan Kolom -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Kolom yang Diexport</label>

                            <!-- Kolom Data Siswa -->
                            <div class="mt-2 mb-4">
                                <p class="font-medium text-sm text-gray-600 mb-2">Data Siswa</p>
                                <div class="grid grid-cols-2 gap-2 md:grid-cols-3 lg:grid-cols-4">
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="col_nama" name="columns[]" type="checkbox" value="nama_siswa"
                                                checked
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="col_nama" class="font-medium text-gray-700">Nama Lengkap</label>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="col_nisn" name="columns[]" type="checkbox" value="nisn"
                                                checked
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="col_nisn" class="font-medium text-gray-700">NISN</label>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="col_jalur" name="columns[]" type="checkbox" value="jalur"
                                                checked
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="col_jalur" class="font-medium text-gray-700">Jalur</label>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="col_status" name="columns[]" type="checkbox" value="status"
                                                checked
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="col_status" class="font-medium text-gray-700">Status</label>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="col_tempat_lahir" name="columns[]" type="checkbox"
                                                value="tempat_lahir" checked
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="col_tempat_lahir" class="font-medium text-gray-700">Tempat
                                                Lahir</label>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="col_tanggal_lahir" name="columns[]" type="checkbox"
                                                value="tanggal_lahir" checked
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="col_tanggal_lahir" class="font-medium text-gray-700">Tanggal
                                                Lahir</label>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="col_jenis_kelamin" name="columns[]" type="checkbox"
                                                value="jenis_kelamin" checked
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="col_jenis_kelamin" class="font-medium text-gray-700">Jenis
                                                Kelamin</label>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="col_agama" name="columns[]" type="checkbox" value="agama"
                                                checked
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="col_agama" class="font-medium text-gray-700">Agama</label>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="col_no_hp" name="columns[]" type="checkbox" value="no_hp"
                                                checked
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="col_no_hp" class="font-medium text-gray-700">No. HP</label>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="col_sekolah_asal" name="columns[]" type="checkbox"
                                                value="sekolah_asal" checked
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="col_sekolah_asal" class="font-medium text-gray-700">Sekolah
                                                Asal</label>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="col_tahun_lulus" name="columns[]" type="checkbox"
                                                value="tahun_lulus" checked
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="col_tahun_lulus" class="font-medium text-gray-700">Tahun
                                                Lulus</label>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="col_nik" name="columns[]" type="checkbox" value="nik"
                                                checked
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="col_nik" class="font-medium text-gray-700">NIK</label>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="col_alamat" name="columns[]" type="checkbox" value="alamat"
                                                checked
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="col_alamat" class="font-medium text-gray-700">Alamat</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Orang Tua -->
                            <div class="mt-2 mb-4">
                                <p class="font-medium text-sm text-gray-600 mb-2">Data Orang Tua</p>
                                <div class="grid grid-cols-2 gap-2 md:grid-cols-3 lg:grid-cols-4">
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="col_nama_ayah" name="columns[]" type="checkbox"
                                                value="nama_ayah" checked
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="col_nama_ayah" class="font-medium text-gray-700">Nama
                                                Ayah</label>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="col_nama_ibu" name="columns[]" type="checkbox"
                                                value="nama_ibu" checked
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="col_nama_ibu" class="font-medium text-gray-700">Nama
                                                Ibu</label>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="col_pekerjaan_ayah" name="columns[]" type="checkbox"
                                                value="pekerjaan_ayah" checked
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="col_pekerjaan_ayah"
                                                class="font-medium text-gray-700">Pekerjaan Ayah</label>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="col_pekerjaan_ibu" name="columns[]" type="checkbox"
                                                value="pekerjaan_ibu" checked
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="col_pekerjaan_ibu" class="font-medium text-gray-700">Pekerjaan
                                                Ibu</label>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="col_penghasilan_ayah" name="columns[]" type="checkbox"
                                                value="penghasilan_ayah" checked
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="col_penghasilan_ayah"
                                                class="font-medium text-gray-700">Penghasilan Ayah</label>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="col_penghasilan_ibu" name="columns[]" type="checkbox"
                                                value="penghasilan_ibu" checked
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="col_penghasilan_ibu"
                                                class="font-medium text-gray-700">Penghasilan Ibu</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Nilai Siswa dengan per Semester - Dinamis berdasarkan database -->
                            <div class="mt-2 mb-4">
                                <p class="font-medium text-sm text-gray-600 mb-2">Nilai Siswa (Per Semester)</p>
                                <div id="nilai-container"
                                    class="grid grid-cols-2 gap-2 md:grid-cols-3 lg:grid-cols-4">
                                    <!-- Contoh nilai berdasarkan format: nilai_{mata_pelajaran}_{semester} -->
                                    @php
                                        // Ambil semua kombinasi unik mata pelajaran dan semester dari database
                                        $nilaiKombinasi = \App\Models\Nilai::select('nama', 'semester')
                                            ->distinct()
                                            ->orderBy('nama')
                                            ->orderBy('semester')
                                            ->get();
                                    @endphp

                                    @foreach ($nilaiKombinasi as $nilai)
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input id="col_nilai_{{ $nilai->nama }}_{{ $nilai->semester }}"
                                                    name="columns[]" type="checkbox"
                                                    value="nilai_{{ $nilai->nama }}_{{ $nilai->semester }}" checked
                                                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="col_nilai_{{ $nilai->nama }}_{{ $nilai->semester }}"
                                                    class="font-medium text-gray-700">
                                                    {{ ucwords(str_replace('_', ' ', $nilai->nama)) }} - Semester
                                                    {{ $nilai->semester }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Berkas Persyaratan - Akan diisi dinamis berdasarkan jalur yang dipilih -->
                            <div class="mt-2 mb-4">
                                <p class="font-medium text-sm text-gray-600 mb-2">Berkas Persyaratan</p>
                                <div id="berkas-container"
                                    class="grid grid-cols-2 gap-2 md:grid-cols-3 lg:grid-cols-4">
                                    <!-- Akan diisi dengan AJAX berdasarkan jalur yang dipilih -->
                                    @if (isset($berkas))
                                        @foreach ($berkas as $berkas_item)
                                            <div class="flex items-start berkas-item"
                                                data-jalur-id="{{ $berkas_item->jalur_pendaftaran_id }}">
                                                <div class="flex items-center h-5">
                                                    <input id="col_berkas_{{ $berkas_item->id }}" name="columns[]"
                                                        type="checkbox" value="berkas_{{ $berkas_item->id }}" checked
                                                        class="berkas-checkbox focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="col_berkas_{{ $berkas_item->id }}"
                                                        class="font-medium text-gray-700">
                                                        {{ $berkas_item->nama_berkas }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Preview & Download Buttons -->
                        <div class="flex space-x-4">
                            <button type="submit" name="action" value="preview"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd"
                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                Preview
                            </button>
                            <button type="submit" name="action" value="download"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                                Download
                            </button>
                        </div>
                    </form>

                    <!-- Preview Area (hanya muncul jika ada preview) -->
                    @if (isset($preview))
                        <div class="mt-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Preview Data</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <!-- Header sesuai kolom yang dipilih -->
                                            @foreach ($columns as $column)
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    @if (strpos($column, 'nilai_') === 0)
                                                        @php
                                                            $parts = explode('_', substr($column, 6));
                                                            if (count($parts) >= 2) {
                                                                $semester = array_pop($parts);
                                                                $mapelName = implode(' ', array_map('ucfirst', $parts));
                                                                echo $mapelName . ' - Semester ' . $semester;
                                                            } else {
                                                                echo ucfirst(str_replace('_', ' ', $column));
                                                            }
                                                        @endphp
                                                    @elseif(strpos($column, 'berkas_') === 0)
                                                        @php
                                                            $berkasId = substr($column, 7);
                                                            $berkasPersyaratan = App\Models\BerkasPersyaratan::find(
                                                                $berkasId,
                                                            );
                                                            echo $berkasPersyaratan
                                                                ? 'Berkas ' . $berkasPersyaratan->nama_berkas
                                                                : 'Berkas';
                                                        @endphp
                                                    @else
                                                        {{ ucfirst(str_replace('_', ' ', $column)) }}
                                                    @endif
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <!-- Data preview -->
                                        @foreach ($preview as $row)
                                            <tr>
                                                @foreach ($columns as $column)
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $row[$column] ?? '-' }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4 text-right">
                                <p class="text-sm text-gray-600">Menampilkan {{ count($preview) }} dari
                                    {{ $total }} data</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    @push('custom-js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#jalur-select').on('change', function() {
                    let jalurId = $(this).val();

                    if (jalurId === 'semua') {
                        $('.berkas-checkbox').prop('checked', true);
                        return;
                    }

                    $.ajax({
                        url: '/admin/berkas-by-jalur/' + jalurId,
                        method: 'GET',
                        success: function(res) {
                            // Reset semua checkbox dulu
                            $('.berkas-checkbox').prop('checked', false);

                            // Centang yang sesuai id-nya
                            res.forEach(function(berkas) {
                                $('#col_berkas_' + berkas.id).prop('checked', true);
                            });
                        },
                        error: function() {
                            alert('Gagal ambil data berkas!');
                        }
                    });
                });

                // Trigger change saat load pertama (opsional)
                $('#jalur-select').trigger('change');
            });
        </script>
    @endpush
</x-app-layout>
