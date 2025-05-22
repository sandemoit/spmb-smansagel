<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f7f9fd] font-sans text-gray-800">
    <!-- Mobile Side Menu (hidden by default) -->
    <div id="sideMenu"
        class="fixed inset-y-0 left-0 transform -translate-x-full w-64 bg-white shadow-lg z-50 transition-transform duration-300 ease-in-out">
        <div class="p-6">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="h-8">
                    <span class="font-bold text-lg text-blue-900">SMAN 1 Gelumbang</span>
                </div>
                <button id="closeSideMenu" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <nav class="space-y-4">
                <a href="{{ url('/') }}"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Beranda</a>
                <a href="https://smanegeri1gelumbang.sch.id/sejarah-singkat/"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Profil
                    Sekolah</a>
                <a href="https://smanegeri1gelumbang.sch.id/berita/"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Berita</a>
                <a href="https://smanegeri1gelumbang.sch.id/galery/"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Galeri</a>
                <a href="https://smanegeri1gelumbang.sch.id/data-sekolah/"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Kontak</a>
                @auth
                    <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
                        class="block px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">Dashboard</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="block px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">Login</a>
                @endauth
            </nav>
        </div>
    </div>

    <!-- Navbar -->
    <header class="bg-white shadow-sm sticky top-0 z-40">
        <div class="max-w-7xl mx-auto flex items-center justify-between py-4 px-4">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="h-10">
                <span class="font-bold text-xl text-blue-900">SMA Negeri 1 Gelumbang</span>
            </div>
            <div class="flex items-center space-x-2">
                <!-- Hamburger menu button (visible on mobile) -->
                <button id="openSideMenu" class="md:hidden text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            @auth
                <nav class="hidden md:flex space-x-6 justify-end">
                    <a href="https://smanegeri1gelumbang.sch.id/sejarah-singkat/"
                        class="text-gray-700 hover:text-gray-900">Profil Sekolah</a>
                    <a href="https://smanegeri1gelumbang.sch.id/berita/"
                        class="text-gray-700 hover:text-gray-900">Berita</a>
                    <a href="https://smanegeri1gelumbang.sch.id/galery/"
                        class="text-gray-700 hover:text-gray-900">Galeri</a>
                    <a href="https://smanegeri1gelumbang.sch.id/data-sekolah/"
                        class="text-gray-700 hover:text-gray-900">Kontak</a>
                    @if (auth()->user()->role == 'admin')
                        <a href="{{ url('/admin/dashboard') }}"
                            class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">Dashboard</a>
                    @else
                        <a href="{{ url('/dashboard') }}"
                            class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">Dashboard</a>
                    @endif
                </nav>
            @else
                <nav class="hidden md:flex space-x-6 justify-end">
                    <a href="https://smanegeri1gelumbang.sch.id/sejarah-singkat/"
                        class="text-gray-700 hover:text-gray-900">Profil Sekolah</a>
                    <a href="https://smanegeri1gelumbang.sch.id/berita/"
                        class="text-gray-700 hover:text-gray-900">Berita</a>
                    <a href="https://smanegeri1gelumbang.sch.id/galery/"
                        class="text-gray-700 hover:text-gray-900">Galeri</a>
                    <a href="https://smanegeri1gelumbang.sch.id/data-sekolah/"
                        class="text-gray-700 hover:text-gray-900">Kontak</a>
                    <a href="{{ route('login') }}"
                        class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">Login</a>
                </nav>
            @endauth
        </div>
    </header>

    <!-- Overlay when side menu is open -->
    <div id="overlay"
        class="fixed inset-0 bg-black opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out z-40">
    </div>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- JavaScript for Side Menu Toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sideMenu = document.getElementById('sideMenu');
            const openSideMenuBtn = document.getElementById('openSideMenu');
            const closeSideMenuBtn = document.getElementById('closeSideMenu');
            const overlay = document.getElementById('overlay');

            // Open side menu
            openSideMenuBtn.addEventListener('click', function() {
                sideMenu.classList.remove('-translate-x-full');
                overlay.classList.add('opacity-50');
                overlay.classList.remove('pointer-events-none');
            });

            // Close side menu
            function closeSideMenu() {
                sideMenu.classList.add('-translate-x-full');
                overlay.classList.remove('opacity-50');
                overlay.classList.add('pointer-events-none');
            }

            closeSideMenuBtn.addEventListener('click', closeSideMenu);
            overlay.addEventListener('click', closeSideMenu);
        });
    </script>
</body>

</html>
