<x-app-layout>
    <div class="md:py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Card Pengumuman -->
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-4 px-6 rounded-t-lg">
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl font-bold">Pengumuman Kelulusan</h1>
                        <div class="text-sm">
                            <p>{{ date('d F Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6 bg-white" id>
                    <!-- Logo Sekolah -->
                    <div class="flex justify-center mb-6">
                        <div class="w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center overflow-hidden">
                            <!-- Ganti dengan logo sekolah yang sebenarnya -->
                            <img src="{{ asset('logo.png') }}" alt="Logo SMAN 1 Gelumbang"
                                class="w-full h-full object-cover" />
                        </div>
                    </div>

                    <!-- Judul Pengumuman -->
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">
                            Selamat! Kamu dinyatakan Diterima
                        </h2>
                        <div class="w-24 h-1 bg-yellow-400 mx-auto"></div>
                    </div>

                    <!-- Informasi Siswa -->
                    <div class="bg-gray-50 p-6 rounded-lg mb-6 border border-gray-200">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-3">
                                <div>
                                    <p class="text-gray-500 text-sm">Nama Lengkap</p>
                                    <p class="font-medium">{{ $student->name ?? 'Nama Siswa' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-sm">Nomor Pendaftaran</p>
                                    <p class="font-medium">{{ $student->registration_number ?? '2024XXXX' }}</p>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-gray-500 text-sm">NISN</p>
                                    <p class="font-medium">{{ $student->nisn ?? 'XXXXXXXXXX' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-sm">Status</p>
                                    <p class="font-medium text-green-600">LULUS</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pesan -->
                    <div class="mb-8 text-center">
                        <p class="text-gray-700 mb-4">
                            Selamat atas kelulusanmu! Silahkan cetak surat keterangan di bawah untuk dibawa pada saat
                            daftar ulang.
                        </p>
                        <p class="text-gray-700 mb-4">
                            Daftar ulang akan dilaksanakan pada tanggal <span class="font-semibold">24 Mei
                                2025</span>.
                        </p>
                        <div class="bg-yellow-50 p-4 rounded-lg border-l-4 border-yellow-400">
                            <p class="text-yellow-800">
                                Harap membawa dokumen asli dan fotokopi semua berkas yang diperlukan saat daftar ulang.
                            </p>
                        </div>
                    </div>

                    <!-- Tombol Download -->
                    <div class="flex justify-center">
                        <a href="#"
                            class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Download Surat Keterangan
                        </a>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 p-4 border-t border-gray-200 text-center text-gray-600 text-sm rounded-b-lg">
                    <p>© {{ date('Y') }} SMA Negeri 1 Gelumbang - Sistem Penerimaan Siswa Baru</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
