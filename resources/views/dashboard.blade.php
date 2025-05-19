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
                        <p>👋 Hai, {{ $siswa->nama_siswa }}. Data kamu sudah lengkap!</p>
                    @else
                        <p class="text-red-500 font-bold">🚨 Data biodata Anda belum lengkap.</p>
                        <a href="#" class="text-blue-600 underline">Lengkapi Biodata Sekarang</a>
                    @endif

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
