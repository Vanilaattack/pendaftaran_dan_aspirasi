<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Himpunan Mahasiswa')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#25B1E0',
                            50:  '#f0faff',
                            100: '#daf3fc',
                            200: '#b8e9f9',
                            500: '#25B1E0',
                            600: '#1490bc',
                            700: '#127398',
                        },
                    },
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                },
            },
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        .btn-primary { background:#25B1E0; transition:background .2s,transform .1s; }
        .btn-primary:hover { background:#1490bc; }
        .btn-primary:active { transform:scale(.98); }
        .input-field { border:1.5px solid #e5e7eb; transition:border-color .2s,box-shadow .2s; }
        .input-field:focus { outline:none; border-color:#25B1E0; box-shadow:0 0 0 3px rgba(37,177,224,.12); }
        .input-error { border-color:#f87171!important; background:#fff5f5; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800 antialiased min-h-screen">

    {{-- Navbar Mahasiswa --}}
    @auth('mahasiswa')
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 h-14 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-primary flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                    </svg>
                </div>
                <span class="font-semibold text-sm text-gray-800">Himpunan Mahasiswa</span>
            </div>
            <div class="flex items-center gap-1">
                <a href="{{ route('mahasiswa.pendaftaran') }}"
                   class="px-3 py-1.5 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('mahasiswa.pendaftaran') ? 'bg-primary-50 text-primary-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800' }}">
                    Pendaftaran
                </a>
                <a href="{{ route('mahasiswa.aspirasi') }}"
                   class="px-3 py-1.5 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('mahasiswa.aspirasi') ? 'bg-primary-50 text-primary-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800' }}">
                    Aspirasi
                </a>
                <form action="{{ route('logout') }}" method="POST" class="ml-2">
                    @csrf
                    <button type="submit" class="text-xs text-red-500 hover:bg-red-50 px-3 py-1.5 rounded-lg transition-colors font-medium">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>
    @endauth

    {{-- Toast --}}
    @if(session('success'))
    <div id="toast" class="fixed top-4 left-1/2 -translate-x-1/2 z-50 w-full max-w-sm px-4">
        <div class="flex items-center gap-3 bg-white rounded-xl shadow-lg border border-primary-100 px-4 py-3">
            <div class="w-7 h-7 rounded-full bg-primary flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <p class="text-sm text-gray-700 font-medium flex-1">{{ session('success') }}</p>
            <button onclick="document.getElementById('toast').remove()" class="text-gray-300 hover:text-gray-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
    <script>setTimeout(()=>{const t=document.getElementById('toast');if(t)t.remove();},4000);</script>
    @endif

    <main>@yield('content')</main>

    @stack('scripts')
</body>
</html>
