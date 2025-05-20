<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f7f9fd] font-sans text-gray-800">

    <!-- Navbar -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto flex items-center justify-between py-6 px-4">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="h-10">
                <span class="font-bold text-xl text-blue-900">SMA Negeri 1 Gelumbang</span>
            </div>
            @auth
                <nav class="hidden md:flex space-x-6">
                    <a href="{{ url('/dashboard') }}"
                        class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">Dashboard</a>
                </nav>
            @else
                <nav class="hidden md:flex space-x-6">
                    <a href="{{ route('login') }}"
                        class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">Login</a>
                </nav>
            @endauth
        </div>
    </header>

    <!-- Main Content -->
    {{ $slot }}

</body>

</html>
