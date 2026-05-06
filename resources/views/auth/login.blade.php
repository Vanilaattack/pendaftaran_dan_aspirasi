<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa — Himpunan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { primary: { DEFAULT:'#25B1E0', 50:'#f0faff', 100:'#daf3fc', 500:'#25B1E0', 600:'#1490bc' } },
                    fontFamily: { sans: ['Poppins','sans-serif'] },
                },
            },
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *{font-family:'Poppins',sans-serif;}
        .input-field{border:1.5px solid #e5e7eb;transition:border-color .2s,box-shadow .2s;}
        .input-field:focus{outline:none;border-color:#25B1E0;box-shadow:0 0 0 3px rgba(37,177,224,.12);}
        .btn-primary{background:#25B1E0;transition:background .2s,transform .1s;}
        .btn-primary:hover{background:#1490bc;}
        .btn-primary:active{transform:scale(.98);}
    </style>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center p-4">

<div class="w-full max-w-sm">

    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-primary shadow-md mb-4">
            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
            </svg>
        </div>
        <h1 class="text-xl font-bold text-gray-800">Login Mahasiswa</h1>
        <p class="text-gray-400 text-sm mt-1">Masuk untuk mengisi form pendaftaran & aspirasi</p>
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

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">NIM</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2"/>
                        </svg>
                    </span>
                    <input type="text" name="nim" value="{{ old('nim') }}"
                           placeholder="Masukkan NIM kamu"
                           autocomplete="username"
                           class="input-field w-full pl-9 pr-4 py-2.5 rounded-xl text-sm">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </span>
                    <input type="password" name="password"
                           placeholder="••••••••"
                           autocomplete="current-password"
                           class="input-field w-full pl-9 pr-4 py-2.5 rounded-xl text-sm">
                </div>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded border-gray-300 accent-[#25B1E0]">
                <label for="remember" class="text-sm text-gray-500">Ingat saya</label>
            </div>

            <button type="submit" class="btn-primary w-full text-white font-semibold text-sm py-2.5 rounded-xl">
                Masuk
            </button>
        </form>
    </div>

    <p class="text-center text-sm text-gray-400 mt-5">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-primary font-medium hover:underline">Daftar di sini →</a>
    </p>

    <p class="text-center text-xs text-gray-300 mt-3">
        <a href="{{ route('admin.login') }}" class="hover:text-gray-400 transition-colors">Login sebagai Admin</a>
    </p>
</div>

</body>
</html>
