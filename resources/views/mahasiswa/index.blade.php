@extends('layout')
@section('title', 'Pendaftaran Anggota — Himpunan Mahasiswa')

@section('content')
<section class="py-12 sm:py-16">
    <div class="max-w-xl mx-auto px-4 sm:px-6">

        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-primary mb-3 shadow-sm">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-800">Form Pendaftaran Anggota</h2>
            <p class="text-gray-400 text-sm mt-1">Isi semua kolom dengan data yang benar</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">

            @if($errors->any())
                <div class="mb-5 bg-red-50 border border-red-100 rounded-xl p-4 flex gap-3">
                    <svg class="w-5 h-5 text-red-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-red-600 mb-1">Mohon perbaiki kesalahan berikut:</p>
                        <ul class="space-y-0.5">
                            @foreach($errors->all() as $error)
                                <li class="text-xs text-red-500">• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('mahasiswa.daftar') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Nama Lengkap <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                           placeholder="Masukkan nama lengkap kamu"
                           class="input-field w-full px-4 py-2.5 rounded-xl text-sm {{ $errors->has('nama_lengkap') ? 'input-error' : '' }}">
                    @error('nama_lengkap')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        NIM <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="nim" value="{{ old('nim') }}"
                           placeholder="Contoh: 2021001234"
                           class="input-field w-full px-4 py-2.5 rounded-xl text-sm {{ $errors->has('nim') ? 'input-error' : '' }}">
                    @error('nim')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Angkatan <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="angkatan" value="{{ old('angkatan') }}"
                           placeholder="Contoh: 2022"
                           class="input-field w-full px-4 py-2.5 rounded-xl text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Pilihan Pertama <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="pilihan_pertama" value="{{ old('pilihan_pertama') }}"
                           class="input-field w-full px-4 py-2.5 rounded-xl text-sm ">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Alasan Memilih Pilihan 1 <span class="text-red-400">*</span>
                    </label>
                    <textarea name="alasan_memilih_pilihan_pertama" rows="4"
                              class="input-field w-full px-4 py-2.5 rounded-xl text-sm resize-none {{ $errors->has('alasan_memilih_pilihan_pertama') ? 'input-error' : '' }}">{{ old('alasan_memilih_pilihan_pertaman') }}</textarea>
                    @error('alasan_memilih_pilihan_pertama')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Pilihan kedua <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="pilihan_kedua" value="{{ old('pilihan_kedua') }}"
                           class="input-field w-full px-4 py-2.5 rounded-xl text-sm ">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Alasan Memilih Pilihan 2 <span class="text-red-400">*</span>
                    </label>
                    <textarea name="alasan_memilih_pilihan_kedua" rows="4"
                              class="input-field w-full px-4 py-2.5 rounded-xl text-sm resize-none {{ $errors->has('alasan_memilih_pilihan_kedua') ? 'input-error' : '' }}">{{ old('alasan_memilih_pilihan_pertaman') }}</textarea>
                    @error('alasan_memilih_pilihan_kedua')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Unggah Foto Profil</label>
                    <input type="file" name="foto" accept="image/*" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-[#25B1E0] focus:border-[#25B1E0]">
                    <p class="text-xs text-gray-500 mt-1">*Format: JPG, PNG (Maks. 2MB)</p>
                </div>

                <button type="submit"
                        class="btn-primary w-full text-white font-semibold text-sm py-3 rounded-xl mt-1
                               flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    Kirim Pendaftaran
                </button>
            </form>
        </div>

        <p class="text-center text-sm text-gray-400 mt-5">
            Punya saran?
            <a href="{{ route('mahasiswa.aspirasi') }}" class="text-primary font-medium hover:underline">Kirim aspirasi →</a>
        </p>
    </div>
</section>
@endsection
