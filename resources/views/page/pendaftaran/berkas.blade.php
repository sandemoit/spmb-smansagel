<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Upload Dokumen
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <ol
            class="flex items-center w-full text-sm font-medium text-center text-gray-500 sm:text-base">
            <li
                class="flex md:w-full items-center text-blue-600 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10">
                <span
                    class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    Daftar <span class="hidden sm:inline-flex sm:ms-2">Akun</span>
                </span>
            </li>
            <li
                class="flex md:w-full items-center text-blue-600 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10">
                <span
                    class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    Melengkapi <span class="hidden sm:inline-flex sm:ms-2">Biodata</span>
                </span>
            </li>
            <li
                class="flex md:w-full items-center text-blue-600 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10">
                <span
                    class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    Masukan <span class="hidden sm:inline-flex sm:ms-2">Nilai</span>
                </span>
            </li>
            <li class="flex items-center text-blue-600">
                <span class="me-2">4</span>
                Unggah <span class="hidden sm:inline-flex sm:ms-2">Dokumen
            </li>
        </ol>
    </div>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h2 class="text-2xl text-center mb-2">Jalur Pendaftaran: {{ $siswa->jalur_pendaftaran->nama }}</h2>
                <form action="{{ route('siswa.berkas.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @foreach ($berkasPersyaratans as $berkas)
                        <div class="mb-4">
                            <label class="block font-medium">
                                {{ $berkas->nama_berkas }}
                                @if ($berkas->is_required)
                                    <span class="text-red-500">*</span>
                                @endif
                            </label>

                            @if ($berkasUploaded->has($berkas->id))
                                <p class="text-green-600 text-sm">
                                    Sudah diupload:
                                    <a href="#" target="_blank" class="underline">
                                        Lihat File
                                    </a>
                                </p>
                            @endif

                            <input type="file" accept=".pdf,.jpg,.jpeg,.png" onchange="checkFileSize(this)"
                                name="berkas[{{ $berkas->id }}]" class="mt-1 block w-full"
                                {{ $berkas->is_required ? 'required' : '' }}>
                            <span class="text-xs text-red-500">* File harus berformat JPG,JPEG, PNG, PDF dan MAX.
                                2MB</span>
                        </div>
                    @endforeach

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Upload dan Submit</button>
                </form>
            </div>
        </div>
    </div>

    @push('custom-js')
        <script>
            function checkFileSize(input) {
                const file = input.files[0];
                if (file.size > 2 * 1024 * 1024) { // 2MB
                    alert("Ukuran file terlalu besar (maks 2MB)");
                    input.value = "";
                }
            }
        </script>
    @endpush
</x-app-layout>
