<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — Himpunan Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#25B1E0',
                            50: '#f0faff',
                            100: '#daf3fc',
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
        .input-field { border: 1.5px solid #e5e7eb; transition: border-color .2s, box-shadow .2s; }
        .input-field:focus { outline: none; border-color: #25B1E0; box-shadow: 0 0 0 3px rgba(37,177,224,.12); }
        .btn-primary { background: #25B1E0; transition: background .2s, transform .1s; }
        .btn-primary:hover { background: #1490bc; }
        .btn-primary:active { transform: scale(0.98); }
    </style>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center p-4">

    <div class="w-full max-w-sm">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-primary shadow-md mb-4">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h1 class="text-xl font-bold text-gray-800">Masuk sebagai Admin</h1>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-7">

            @if($errors->any())
                <div class="mb-5 flex items-center gap-2.5 bg-red-50 border border-red-100 rounded-xl px-4 py-3">
                    <svg class="w-4 h-4 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm text-red-600">{{ $errors->first() }}</p>
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Username</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>
                        <input type="text" name="username" value="{{ old('username') }}"
                               placeholder="Masukkan username"
                               autocomplete="username"
                               class="input-field w-full pl-9 pr-4 py-2.5 rounded-xl text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        <input type="password" name="password"
                               placeholder="••••••••"
                               autocomplete="current-password"
                               class="input-field w-full pl-9 pr-4 py-2.5 rounded-xl text-sm">
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" id="remember" name="remember"
                           class="w-4 h-4 rounded border-gray-300 accent-primary">
                    <label for="remember" class="text-sm text-gray-500">Ingat saya</label>
                </div>

                <button type="submit" class="btn-primary w-full text-white font-semibold text-sm py-2.5 rounded-xl">
                    Masuk ke Dashboard
                </button>
            </form>
        </div>
    </div>

</body>
</html>
