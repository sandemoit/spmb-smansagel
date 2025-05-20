<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lengkapi Biodata') }}
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 py-8 px-4">
        <ol
            class="flex items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base">
            <li
                class="flex md:w-full items-center text-blue-600 dark:text-blue-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                <span
                    class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    Daftar <span class="hidden sm:inline-flex sm:ms-2">Akun</span>
                </span>
            </li>
            <li
                class="flex md:w-full items-center text-blue-600 dark:text-blue-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                <span
                    class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                    <span class="me-2">2</span>
                    Melengkapi <span class="hidden sm:inline-flex sm:ms-2">Biodata</span>
                </span>
            </li>
            <li
                class="flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                <span
                    class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                    <span class="me-2">3</span>
                    Masukan <span class="hidden sm:inline-flex sm:ms-2">Nilai</span>
                </span>
            </li>
            <li class="flex items-center">
                <span class="me-2">4</span>
                Unggah <span class="hidden sm:inline-flex sm:ms-2">Dokumen
            </li>
        </ol>
    </div>

    <div class="">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <form action="{{ route('siswa.biodata.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <h2 class="text-xl font-semibold">Biodata Siswa</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_siswa" value="{{ old('nama_siswa', $siswa->nama_siswa) }}"
                                class="w-full border rounded p-2" required>
                            <x-input-error :messages="$errors->get('nama_siswa')" class="mt-2" />
                        </div>

                        <div>
                            <label>NISN</label>
                            <input type="text" name="nisn" value="{{ old('nisn', $siswa->nisn) }}"
                                class="w-full border rounded p-2" required>
                            <x-input-error :messages="$errors->get('nisn')" class="mt-2" />
                        </div>

                        <div>
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir"
                                value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}"
                                class="w-full border rounded p-2" required>
                            <x-input-error :messages="$errors->get('tempat_lahir')" class="mt-2" />
                        </div>

                        <div>
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir"
                                value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}"
                                class="w-full border rounded p-2" required>
                            <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
                        </div>

                        <div>
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="w-full border rounded p-2" required>
                                <option value="Laki-laki" {{ $siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>
                                <option value="Perempuan" {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
                        </div>

                        <div>
                            <label>Agama</label>
                            <input type="text" name="agama" value="{{ old('agama', $siswa->agama) }}"
                                class="w-full border rounded p-2" required>
                            <x-input-error :messages="$errors->get('agama')" class="mt-2" />
                        </div>

                        <div>
                            <label>No. HP</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp', $siswa->no_hp) }}"
                                class="w-full border rounded p-2" required>
                            <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
                        </div>

                        <div>
                            <label>Asal Sekolah</label>
                            <input type="text" name="sekolah_asal"
                                value="{{ old('sekolah_asal', $siswa->sekolah_asal) }}"
                                class="w-full border rounded p-2" required>
                            <x-input-error :messages="$errors->get('sekolah_asal')" class="mt-2" />
                        </div>

                        <div>
                            <label>Tahun Lulus</label>
                            <input type="number" name="tahun_lulus"
                                value="{{ old('tahun_lulus', $siswa->tahun_lulus) }}" class="w-full border rounded p-2"
                                required>
                            <x-input-error :messages="$errors->get('tahun_lulus')" class="mt-2" />
                        </div>

                        <div>
                            <label>Latitude</label>
                            <input type="text" name="latitude" value="{{ old('latitude', $siswa->latitude) }}"
                                class="w-full border rounded p-2" placeholder="Contoh: -2.9630674216609267" required>
                            <span class="text-blue-500 underline"><a
                                    href="https://www.youtube.com/watch?v=Xha1RTiZ5zQ">Lihat tutorial nya disini jika
                                    belum paham</a></span>
                            <x-input-error :messages="$errors->get('latitude')" class="mt-2" />
                        </div>

                        <div>
                            <label>Longitude</label>
                            <input type="text" name="longitude" value="{{ old('longitude', $siswa->longitude) }}"
                                class="w-full border rounded p-2" placeholder="Contoh: 104.8078575551942" required>
                            <span class="text-blue-500 underline"><a
                                    href="https://www.youtube.com/watch?v=Xha1RTiZ5zQ">Lihat tutorial nya disini jika
                                    belum paham</a></span>
                            <x-input-error :messages="$errors->get('longitude')" class="mt-2" />
                        </div>

                        <div>
                            <label>Jarak Kesekolah</label>
                            <input type="number" name="jarak_kesekolah" value="{{ $siswa->jarak_kesekolah }}"
                                class="disabled:opacity-50 w-full border rounded p-2"
                                placeholder="Muncul Setelah Submit">
                            <x-input-error :messages="$errors->get('jarak_kesekolah')" class="mt-2" />
                        </div>

                        <div>
                            <label>Photo (3 x 4) </label>
                            <input type="file" name="foto_3x4" value="{{ old('foto_3x4', $siswa->foto_3x4) }}"
                                class="w-full border rounded p-2">
                            <span class="text-red-500 text-sm block">* Format JPEG, PNG, JPG, PDF</span>
                            <x-input-error :messages="$errors->get('foto_3x4')" class="mt-2" />
                        </div>

                        <div>
                            <label>KK (Kartu Keluarga)</label>
                            <input type="file" name="upload_kk" value="{{ old('upload_kk', $siswa->upload_kk) }}"
                                class="w-full border rounded p-2">
                            <span class="text-red-500 text-sm block">* KK harus dilegalisir kelurahan | Format JPEG,
                                PNG, JPG, PDF</span>
                            <x-input-error :messages="$errors->get('upload_kk')" class="mt-2" />
                        </div>

                        <div>
                            <label>NIK (Nomor Induk Keluarga)</label>
                            <input type="text" name="nik" value="{{ old('nik', $siswa->nik) }}"
                                class="w-full border rounded p-2" required>
                            <x-input-error :messages="$errors->get('nik')" class="mt-2" />
                        </div>

                        <div>
                            <label>Jalur Pendaftaran</label>
                            <select name="jalur_pendaftaran_id" class="w-full border rounded p-2" required>
                                @foreach ($jalurs as $jalur)
                                    <option value="{{ $jalur->id }}"
                                        {{ $siswa->jalur_pendaftaran_id == $jalur->id ? 'selected' : '' }}>
                                        {{ $jalur->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('jalur_pendaftaran_id')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-6">
                        <label>Alamat Lengkap</label>
                        <textarea name="alamat" rows="4" class="w-full border rounded p-2" required>{{ old('alamat', $siswa->alamat) }}</textarea>
                        <x-input-error :messages="$errors->get('alamat')" class="mt-2" />

                    </div>

                    <h2 class="text-xl font-semibold mt-4">Biodata Orang Tua</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label>Nama Ayah</label>
                            <input type="text" name="nama_ayah" value="{{ old('nama_ayah', $siswa->nama_ayah) }}"
                                class="w-full border rounded p-2" required>
                            <x-input-error :messages="$errors->get('nama_ayah')" class="mt-2" />
                        </div>

                        <div>
                            <label>Pekerjaan Ayah</label>
                            <input type="text" name="pekerjaan_ayah"
                                value="{{ old('pekerjaan_ayah', $siswa->pekerjaan_ayah) }}"
                                class="w-full border rounded p-2" required>
                            <x-input-error :messages="$errors->get('pekerjaan_ayah')" class="mt-2" />
                        </div>

                        <div>
                            <label>Penghasilan Ayah</label>
                            <input type="number" name="penghasilan_ayah"
                                value="{{ old('penghasilan_ayah', $siswa->penghasilan_ayah) }}"
                                class="w-full border rounded p-2" required>
                            <x-input-error :messages="$errors->get('penghasilan_ayah')" class="mt-2" />
                        </div>

                        <div>
                            <label>Nama Ibu</label>
                            <input type="text" name="nama_ibu" value="{{ old('nama_ibu', $siswa->nama_ibu) }}"
                                class="w-full border rounded p-2" required>
                            <x-input-error :messages="$errors->get('nama_ibu')" class="mt-2" />
                        </div>

                        <div>
                            <label>Pekerjaan Ibu</label>
                            <input type="text" name="pekerjaan_ibu"
                                value="{{ old('pekerjaan_ibu', $siswa->pekerjaan_ibu) }}"
                                class="w-full border rounded p-2" required>
                            <x-input-error :messages="$errors->get('pekerjaan_ibu')" class="mt-2" />
                        </div>

                        <div>
                            <label>Penghasilan Ibu</label>
                            <input type="number" name="penghasilan_ibu"
                                value="{{ old('penghasilan_ibu', $siswa->penghasilan_ibu) }}"
                                class="w-full border rounded p-2" required>
                            <x-input-error :messages="$errors->get('penghasilan_ibu')" class="mt-2" />
                        </div>
                    </div>

                    @if ($siswa->is_complete)
                        <div class="mt-6">
                            <button disabled readonly
                                class="disabled:opacity-50 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Tidak Dapat Mengubah Data Lagi
                            </button>
                        </div>
                    @else
                        <div class="mt-6">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Simpan Biodata
                            </button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
