<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun — Himpunan</title>
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

    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-primary shadow-md mb-4">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
        </div>
        <h1 class="text-xl font-bold text-gray-800">Buat Akun Mahasiswa</h1>
        <p class="text-gray-400 text-sm mt-1">Daftar untuk mengakses form pendaftaran</p>
    </div>

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

        <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-400">*</span></label>
                <input type="text" name="nama" value="{{ old('nama') }}"
                       placeholder="Nama lengkap kamu"
                       class="input-field w-full px-4 py-2.5 rounded-xl text-sm {{ $errors->has('nama') ? 'input-error' : '' }}">
                @error('nama')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">NIM <span class="text-red-400">*</span></label>
                <input type="text" name="nim" value="{{ old('nim') }}"
                       placeholder="Nomor Induk Mahasiswa"
                       class="input-field w-full px-4 py-2.5 rounded-xl text-sm {{ $errors->has('nim') ? 'input-error' : '' }}">
                @error('nim')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Password <span class="text-red-400">*</span></label>
                <input type="password" name="password"
                       placeholder="Minimal 6 karakter"
                       autocomplete="new-password"
                       class="input-field w-full px-4 py-2.5 rounded-xl text-sm {{ $errors->has('password') ? 'input-error' : '' }}">
                @error('password')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password <span class="text-red-400">*</span></label>
                <input type="password" name="password_confirmation"
                       placeholder="Ulangi password"
                       autocomplete="new-password"
                       class="input-field w-full px-4 py-2.5 rounded-xl text-sm">
            </div>

            <button type="submit" class="btn-primary w-full text-white font-semibold text-sm py-2.5 rounded-xl flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Buat Akun
            </button>
        </form>
    </div>

    <p class="text-center text-sm text-gray-400 mt-5">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-primary font-medium hover:underline">Login di sini →</a>
    </p>
</div>

</body>
</html>
