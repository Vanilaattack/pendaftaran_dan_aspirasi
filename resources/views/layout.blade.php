<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Himpunan Mahasiswa Informatika')</title>

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
                            300: '#7dd8f4',
                            400: '#3bbde6',
                            500: '#25B1E0',
                            600: '#1490bc',
                            700: '#127398',
                            800: '#145f7c',
                            900: '#164f68',
                        },
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                },
            },
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Poppins', sans-serif; }
        .btn-primary {
            background: #25B1E0;
            transition: background 0.2s, opacity 0.2s, transform 0.1s;
        }
        .btn-primary:hover { background: #1490bc; }
        .btn-primary:active { transform: scale(0.98); }
        .input-field {
            border: 1.5px solid #e5e7eb;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .input-field:focus {
            outline: none;
            border-color: #25B1E0;
            box-shadow: 0 0 0 3px rgba(37,177,224,0.12);
        }
        .input-error {
            border-color: #f87171 !important;
            background: #fff5f5;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    {{-- Navbar --}}
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
        <div class="max-w-5xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-14">

                <a href="{{ route('mahasiswa.index') }}" class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center shadow-sm">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-800 text-sm">Himpunan Mahasiswa Informatika</span>
                </a>

                <div class="flex items-center gap-1">
                    <a href="{{ route('mahasiswa.index') }}"
                       class="px-3 py-1.5 rounded-lg text-sm font-medium transition-colors
                              {{ request()->routeIs('mahasiswa.index') ? 'bg-primary-50 text-primary-600' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' }}">
                        Pendaftaran
                    </a>
                    <a href="{{ route('mahasiswa.aspirasi') }}"
                       class="px-3 py-1.5 rounded-lg text-sm font-medium transition-colors
                              {{ request()->routeIs('mahasiswa.aspirasi') ? 'bg-primary-50 text-primary-600' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' }}">
                        Aspirasi
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Toast Notifikasi Sukses --}}
    @if(session('success'))
        <div id="toast"
             class="fixed top-4 left-1/2 -translate-x-1/2 z-50 w-full max-w-sm px-4
                    transition-all duration-300">
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
        <script>setTimeout(() => { const t = document.getElementById('toast'); if(t) t.remove(); }, 4000);</script>
    @endif

    <main>@yield('content')</main>

    <footer class="bg-white border-t border-gray-100 mt-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 py-6 flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="flex items-center gap-2">
                <div class="w-5 h-5 rounded bg-primary flex items-center justify-center">
                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84l7 3a1 1 0 00.788 0l7-3a1 1 0 000-1.84l-7-3z"/>
                    </svg>
                </div>
                <span class="text-xs text-gray-400">Himpunan Mahasiswa &copy; {{ date('Y') }}</span>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
