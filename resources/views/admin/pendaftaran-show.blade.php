<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Siswa
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6 space-y-8">

        {{-- Button Verifikasi --}}
        @if ($siswa->status == 'pending')
            <div class="flex justify-start">
                <div x-data="{ warning: false }">
                    <button @click="warning = true"
                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Verifikasi
                    </button>

                    <div x-show="warning" class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mt-4"
                        role="alert">
                        <p class="font-bold">Peringatan</p>
                        <p>Anda akan mengubah status pendaftaran menjadi "Butuh diverifikasi". Pastikan Anda telah
                            memeriksa
                            data
                            siswa
                            dengan
                            benar.</p>
                        <form action="{{ route('admin.updateStatus', $siswa->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="verifikasi">
                            <button type="submit"
                                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">
                                Ya, saya yakin
                            </button>
                            <button type="button" @click="warning = false"
                                class="focus:outline-none text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">
                                Batal
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        {{-- BIODATA --}}
        <div class="bg-white shadow-md rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-700">🧑‍🎓 Biodata</h3>
            <div class="flex flex-col md:flex-row gap-6">
                <div class="flex-1 grid grid-cols-1 gap-4 text-sm text-gray-600">
                    <div class="md:grid md:grid-cols-2">
                        <div><strong>No Pendaftaran:</strong> {{ $siswa->no_pendaftaran }}</div>
                        <div><strong>Nama:</strong> {{ $siswa->nama_siswa }}</div>
                    </div>
                    <div class="md:grid md:grid-cols-2">
                        <div><strong>NISN:</strong> {{ $siswa->nisn }}</div>
                        <div><strong>TTL:</strong> {{ $siswa->tempat_lahir }}, {{ $siswa->tanggal_lahir }}</div>
                    </div>
                    <div class="md:grid md:grid-cols-2">
                        <div><strong>Jenis Kelamin:</strong> {{ $siswa->jenis_kelamin }}</div>
                        <div><strong>Agama:</strong> {{ $siswa->agama }}</div>
                    </div>
                    <div class="md:grid md:grid-cols-2">
                        <div><strong>No HP:</strong> {{ $siswa->no_hp }}</div>
                        <div><strong>Sekolah Asal:</strong> {{ $siswa->sekolah_asal }}</div>
                    </div>
                    <div class="md:grid md:grid-cols-2">
                        <div><strong>Tahun Lulus:</strong> {{ $siswa->tahun_lulus }}</div>
                        <div><strong>Jalur Pendaftaran:</strong> {{ $siswa->jalur_pendaftaran->nama ?? '-' }}</div>
                    </div>
                    <div class="md:grid md:grid-cols-2">
                        <div><strong>Alamat Lengkap:</strong> {{ $siswa->alamat }}</div>
                    </div>
                    <div class="md:grid md:grid-cols-2">
                        <div><strong>Nama Ayah:</strong> {{ $siswa->nama_ayah }}</div>
                        <div><strong>Pekerjaan Ayah:</strong> {{ $siswa->pekerjaan_ayah }}</div>
                    </div>
                    <div class="md:grid md:grid-cols-2">
                        <div><strong>Penghasilan Ayah:</strong>
                            {{ number_format($siswa->penghasilan_ayah, 0, ',', '.') }}</div>
                        <div><strong>Nama Ibu:</strong> {{ $siswa->nama_ibu }}</div>
                    </div>
                    <div class="md:grid md:grid-cols-2">
                        <div><strong>Pekerjaan Ibu:</strong> {{ ucwords(strtolower($siswa->pekerjaan_ibu)) }}</div>
                        <div><strong>Penghasilan Ibu:</strong> {{ $siswa->penghasilan_ibu }}</div>
                    </div>
                    <div class="md:grid md:grid-cols-2">
                        <div><strong>Status:</strong>
                            <span class="px-2 py-1 rounded-full bg-blue-100 text-blue-600 text-xs">
                                @switch($siswa->status)
                                    @case('diterima')
                                        Diterima
                                    @break

                                    @case('pending')
                                        Butuh diverifikasi
                                    @break

                                    @case('tidak_lolos')
                                        Ditolak
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
                            </span>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-48 flex-shrink-0">
                    @if ($siswa->foto_3x4)
                        <img src="{{ asset($siswa->foto_3x4) }}" alt="Foto Siswa"
                            class="w-full h-64 object-cover rounded-lg shadow">
                    @else
                        <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                            <span class="text-gray-400">Tidak ada foto</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- NILAI --}}
        <div class="bg-white shadow-md rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">📚 Nilai</h3>

            @if ($siswa->nilai->count())
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left border border-gray-200">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-4 py-2">Mata Pelajaran</th>
                                <th class="px-4 py-2">Nilai</th>
                                <th class="px-4 py-2">Semester</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($siswa->nilai as $nilai)
                                <tr>
                                    <td class="px-4 py-2">{{ $nilai->nama }}</td>
                                    <td class="px-4 py-2">{{ $nilai->nilai }}</td>
                                    <td class="px-4 py-2">{{ $nilai->semester }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-sm text-red-500">Belum ada data nilai.</p>
            @endif
        </div>

        {{-- BERKAS --}}
        <div class="bg-white shadow-md rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">📎 Berkas</h3>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border border-gray-200">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2">Nama Berkas</th>
                            <th class="px-4 py-2">File</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($berkasPersyaratan as $berkas)
                            <tr>
                                <td class="px-4 py-2">{{ $berkas->nama_berkas }}</td>
                                <td class="px-4 py-2">
                                    @if ($berkasUploaded->has($berkas->id))
                                        <a href="{{ asset($berkasUploaded[$berkas->id]->path_upload) }}"
                                            class="text-blue-600 underline" target="_blank">
                                            📄 Lihat File
                                        </a>
                                    @else
                                        <span class="text-red-500 italic">Belum Upload</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
