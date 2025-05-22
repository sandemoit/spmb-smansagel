<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📋 Daftar Siswa
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 py-6">

        <!-- Filter Jalur Pendaftaran -->
        <div class="bg-white p-4 shadow rounded-xl mb-6">
            <h3 class="font-semibold text-gray-700 mb-3">Filter Berdasarkan Jalur Pendaftaran</h3>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('pendaftaran') }}"
                    class="inline-block px-4 py-2 rounded-lg {{ request()->query('jalur') ? 'bg-gray-200 text-gray-800' : 'bg-blue-600 text-white' }} hover:bg-blue-700 hover:text-white transition duration-200">
                    Semua
                </a>
                @foreach ($jalurList as $jalur)
                    <a href="{{ route('pendaftaran', ['jalur' => $jalur->id]) }}"
                        class="inline-block px-4 py-2 rounded-lg {{ request()->query('jalur') == $jalur->id ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800' }} hover:bg-blue-700 hover:text-white transition duration-200">
                        {{ $jalur->nama }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="bg-white p-4 shadow rounded-xl overflow-x-auto">
            <table id="pagination-table" class="display w-full text-sm text-left">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th>No Pendaftaran</th>
                        <th>Nama</th>
                        <th>NISN</th>
                        <th>Jalur Pendaftaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswaList as $siswa)
                        <tr>
                            <td>{{ $siswa->no_pendaftaran }}</td>
                            <td>{{ $siswa->nama_siswa }}</td>
                            <td>{{ $siswa->nisn }}</td>
                            <td>{{ $siswa->jalur_pendaftaran ? $siswa->jalur_pendaftaran->nama : 'Tidak ada jalur' }}
                            </td>
                            <td
                                class="
                                {{ $siswa->status == 'diterima' ? 'text-green-600' : '' }}
                                {{ $siswa->status == 'tidak_lolos' ? 'text-red-600' : '' }}
                                {{ $siswa->status == 'verifikasi' ? 'text-yellow-600' : '' }}
                                {{ $siswa->status == 'tidak_lengkap' ? 'text-gray-600' : '' }}
                            ">
                                @switch($siswa->status)
                                    @case('diterima')
                                        Diterima
                                    @break

                                    @case('pending')
                                        Butuh diverifikasi
                                    @break

                                    @case('tidak_lolos')
                                        Tidak Lolog
                                    @break

                                    @case('verifikasi')
                                        Sudah diverifikasi
                                    @break

                                    @case('tidak_lengkap')
                                        Belum lengkap
                                    @break

                                    @default
                                        {{ $siswa->status }}
                                @endswitch
                            </td>
                            <td>
                                <a href="{{ route('pendaftaran.show', $siswa->id) }}"
                                    class="text-blue-600 hover:underline">Detail</a>
                                <a href="{{ route('data.siswa.pdf', $siswa->no_pendaftaran) }}"
                                    class="text-green-600 hover:underline">Cetak</a>

                                <form action="{{ route('pendaftaran.destroy', $siswa->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:underline focus:outline-none">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @push('custom-js')
        {{-- jQuery --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        {{-- DataTables --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#pagination-table').DataTable();
            });
        </script>
    @endpush
</x-app-layout>
