<x-app-layout>
    <div class="md:py-12 mt-8">
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

                {{-- konten --}}
                <div class="bg-indigo-50 p-6 border border-indigo-200 shadow-sm">
                    <h3 class="text-lg font-semibold text-indigo-700 mb-3 text-center">Waktu Pengumuman Kelulusan</h3>

                    <div class="bg-white rounded-lg p-8 shadow-inner">
                        <img src="{{ asset('pengumuman.svg') }}" alt="Celebrate" class="mx-auto w-1/2 md:w-1/3 mb-6">
                        <div class="text-center mb-3">
                            <span class="text-sm text-gray-600">Pengumuman resmi dalam:</span>
                        </div>

                        <div class="flex justify-center space-x-4" id="countdown-container">
                            <div class="text-center">
                                <div class="bg-blue-600 text-white rounded-lg w-16 h-16 flex items-center justify-center text-2xl font-bold"
                                    id="days">00</div>
                                <span class="text-xs mt-1 text-gray-600">Hari</span>
                            </div>
                            <div class="text-center">
                                <div class="bg-blue-600 text-white rounded-lg w-16 h-16 flex items-center justify-center text-2xl font-bold"
                                    id="hours">00</div>
                                <span class="text-xs mt-1 text-gray-600">Jam</span>
                            </div>
                            <div class="text-center">
                                <div class="bg-blue-600 text-white rounded-lg w-16 h-16 flex items-center justify-center text-2xl font-bold"
                                    id="minutes">00</div>
                                <span class="text-xs mt-1 text-gray-600">Menit</span>
                            </div>
                            <div class="text-center">
                                <div class="bg-blue-600 text-white rounded-lg w-16 h-16 flex items-center justify-center text-2xl font-bold"
                                    id="seconds">00</div>
                                <span class="text-xs mt-1 text-gray-600">Detik</span>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <p class="text-sm font-medium text-gray-700" id="countdown-message">Tunggu pengumuman resmi!
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 p-4 border-t border-gray-200 text-center text-gray-600 text-sm rounded-b-lg">
                    <p>© {{ date('Y') }} SMA Negeri 1 Gelumbang - Sistem Penerimaan Siswa Baru</p>
                </div>
            </div>
        </div>
    </div>

    @push('custom-js')
        <script>
            // Fungsi untuk menghitung waktu mundur
            function startCountdown() {
                // Set tanggal target (1 Juni 2025)
                const targetDate = new Date("May 21, 2025 00:00:00").getTime();

                // Update hitungan setiap 1 detik
                const countdownTimer = setInterval(function() {
                    // Waktu sekarang
                    const now = new Date().getTime();

                    // Selisih waktu
                    const distance = targetDate - now;

                    // Perhitungan waktu untuk hari, jam, menit, dan detik
                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Tampilkan hasil di elemen dengan id yang sesuai
                    document.getElementById("days").innerHTML = days.toString().padStart(2, '0');
                    document.getElementById("hours").innerHTML = hours.toString().padStart(2, '0');
                    document.getElementById("minutes").innerHTML = minutes.toString().padStart(2, '0');
                    document.getElementById("seconds").innerHTML = seconds.toString().padStart(2, '0');

                    // Jika hitungan selesai
                    if (distance < 0) {
                        clearInterval(countdownTimer);
                        document.getElementById("days").innerHTML = "00";
                        document.getElementById("hours").innerHTML = "00";
                        document.getElementById("minutes").innerHTML = "00";
                        document.getElementById("seconds").innerHTML = "00";
                        const button = document.createElement("a");
                        button.href = "{{ route('siswa.pengumuman.show') }}";
                        button.classList.add("bg-green-600", "text-white", "font-bold", "px-4", "py-2", "rounded");
                        button.innerHTML = "Lihat Pengumuman";
                        document.getElementById("countdown-message").innerHTML = "";
                        document.getElementById("countdown-message").appendChild(button);

                        // Ubah warna background timer menjadi hijau
                        const timerBoxes = document.querySelectorAll("#countdown-container > div > div");
                        timerBoxes.forEach(box => {
                            box.classList.remove("bg-indigo-600");
                            box.classList.add("bg-green-600");
                        });
                    }
                }, 1000);
            }

            // Panggil fungsi saat halaman dimuat
            document.addEventListener("DOMContentLoaded", startCountdown);
        </script>
    @endpush
</x-app-layout>
