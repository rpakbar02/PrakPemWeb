<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor Pak! - Sistem Pengaduan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    
    <nav class="bg-blue-700 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('tickets.index') }}" class="text-xl font-bold tracking-wide">Lapor Pak!</a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <span class="text-sm text-blue-200">Halo, {{ Auth::user()->name }}</span>
                        
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="px-3 py-1 bg-red-600 hover:bg-red-700 rounded text-sm transition text-white">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-white hover:text-blue-200 text-sm font-medium transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-white text-blue-700 hover:bg-blue-50 px-3 py-1 rounded text-sm font-bold transition">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        
        @if($errors->any())
            <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error) 
                        <li>{{ $error }}</li> 
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>