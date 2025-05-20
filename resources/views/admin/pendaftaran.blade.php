<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">📋 Daftar Siswa</h1>

        <div class="bg-white p-4 shadow rounded-xl">
            <table id="table-siswa" class="display w-full text-sm text-left">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th>Nama</th>
                        <th>NISN</th>
                        <th>No Pendaftaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswaList as $siswa)
                        <tr>
                            <td>{{ $siswa->nama_siswa }}</td>
                            <td>{{ $siswa->nisn }}</td>
                            <td>{{ $siswa->no_pendaftaran }}</td>
                            <td
                                class="
                                {{ $siswa->status == 'diterima' ? 'text-green-600' : '' }}
                                {{ $siswa->status == 'ditolak' ? 'text-red-600' : '' }}
                                {{ $siswa->status == 'verifikasi' ? 'text-yellow-600' : '' }}
                                {{ $siswa->status == 'tidak_lengkap' ? 'text-gray-600' : '' }}
                            ">
                                @switch($siswa->status)
                                    @case('diterima')
                                        Diterima
                                    @break

                                    @case('ditolak')
                                        Ditolak
                                    @break

                                    @case('verifikasi')
                                        Sedang diverifikasi
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
                                <a href="{{ route('data.siswa.pdf', $siswa->id) }}"
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
                $('#table-siswa').DataTable();
            });
        </script>
    @endpush
</x-app-layout>
