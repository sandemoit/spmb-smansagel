<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($siswa && $isComplete)
                        <p>👋 Hai, {{ $siswa->nama_siswa }}. Data kamu sudah lengkap! Silahkan <span
                                class="text-blue-600 underline">Download Lembaran
                                Verifikasi dan Data Kamu</span> di bawah, lalu datang ke-sekolah
                            untuk
                            verifikasi data</p>
                        <div class="flex gap-3">
                            <p class="mt-4"><a href="{{ route('generate.lembarVerifikasi') }}"
                                    class="bg-green-600 text-white px-4 py-2 rounded">Download Data Kamu</a>
                            <p class="mt-4"><a href="{{ asset('berkas/lembar_verifikasi.pdf') }}"
                                    download="lembar_verifikasi.pdf"
                                    class="bg-orange-600 text-white px-4 py-2 rounded">Download
                                    Lembar Verifikasi</a></p>
                            </p>
                        </div>
                    @else
                        <p class="text-red-500 font-bold">🚨 Data kamu belum lengkap.</p>

                        @if (!$biodataComplete && !$berkasComplete)
                            <a href="{{ route('siswa.biodata') }}" class="text-blue-600 underline">Lengkapi Biodata
                                Sekarang</a>
                        @elseif (!$biodataComplete)
                            <a href="{{ route('siswa.biodata') }}" class="text-blue-600 underline">Lengkapi Biodata
                                Sekarang</a>
                        @elseif (!$nilaiComplete)
                            <a href="{{ route('siswa.nilai') }}" class="text-blue-600 underline">Lengkapi Nilai
                                Sekarang</a>
                        @elseif (!$berkasComplete)
                            <a href="{{ route('siswa.berkas') }}" class="text-blue-600 underline">Lengkapi Berkas
                                Sekarang</a>
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
