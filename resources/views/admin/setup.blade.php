<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Admin — Himpunan</title>
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
        .input-error{border-color:#f87171!important;background:#fff5f5;}
        .btn-primary{background:#25B1E0;transition:background .2s,transform .1s;}
        .btn-primary:hover{background:#1490bc;}
        .btn-primary:active{transform:scale(.98);}
    </style>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center p-4">

<div class="w-full max-w-sm">

    {{-- Header --}}
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-primary shadow-md mb-4">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <h1 class="text-xl font-bold text-gray-800">Buat Akun Admin</h1>
        <p class="text-gray-400 text-sm mt-1">Isi username dan password yang ingin kamu gunakan</p>
    </div>

    {{-- Info --}}
    <div class="flex items-start gap-2.5 bg-primary-50 border border-primary-100 rounded-xl px-4 py-3 mb-5">
        <svg class="w-4 h-4 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <p class="text-xs text-primary-700">
            Halaman ini hanya muncul sekali. Setelah akun dibuat, gunakan username dan password ini untuk login admin.
        </p>
    </div>

    {{-- Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-7">

        @if($errors->any())
        <div class="mb-5 bg-red-50 border border-red-100 rounded-xl p-4">
            <p class="text-sm font-semibold text-red-600 mb-1">Perbaiki kesalahan berikut:</p>
            <ul class="space-y-0.5">
                @foreach($errors->all() as $error)
                <li class="text-xs text-red-500">• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.setup.post') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Nama --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Nama Lengkap <span class="text-red-400">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </span>
                    <input type="text" name="name" value="{{ old('name') }}"
                           placeholder="Nama lengkap admin"
                           class="input-field w-full pl-9 pr-4 py-2.5 rounded-xl text-sm {{ $errors->has('name') ? 'input-error' : '' }}">
                </div>
                @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            {{-- Username --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Username <span class="text-red-400">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </span>
                    <input type="text" name="username" value="{{ old('username') }}"
                           placeholder="Contoh: admin_himpunan"
                           autocomplete="username"
                           class="input-field w-full pl-9 pr-4 py-2.5 rounded-xl text-sm {{ $errors->has('username') ? 'input-error' : '' }}">
                </div>
                <p class="mt-1 text-xs text-gray-400">Huruf, angka, strip (-), underscore (_)</p>
                @error('username')<p class="mt-0.5 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Password <span class="text-red-400">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </span>
                    <input type="password" name="password"
                           placeholder="Minimal 6 karakter"
                           autocomplete="new-password"
                           class="input-field w-full pl-9 pr-4 py-2.5 rounded-xl text-sm {{ $errors->has('password') ? 'input-error' : '' }}">
                </div>
                @error('password')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Konfirmasi Password <span class="text-red-400">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </span>
                    <input type="password" name="password_confirmation"
                           placeholder="Ulangi password"
                           autocomplete="new-password"
                           class="input-field w-full pl-9 pr-4 py-2.5 rounded-xl text-sm">
                </div>
            </div>

            <button type="submit"
                    class="btn-primary w-full text-white font-semibold text-sm py-2.5 rounded-xl flex items-center justify-center gap-2 mt-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Buat Akun Admin
            </button>
        </form>
    </div>

</div>

</body>
</html>
