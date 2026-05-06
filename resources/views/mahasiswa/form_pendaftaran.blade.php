@extends('layout')
@section('title', 'Form Pendaftaran — Himpunan')

@section('content')
<section class="py-10 sm:py-14">
<div class="max-w-2xl mx-auto px-4 sm:px-6">

    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-primary mb-3 shadow-sm">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
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

        <form action="{{ route('mahasiswa.pendaftaran.store') }}" method="POST"
              enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- Nama & NIM --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-400">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                           placeholder="Nama lengkap"
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
            </div>

            {{-- Angkatan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Angkatan <span class="text-red-400">*</span></label>
                <input type="text" name="angkatan" value="{{ old('angkatan') }}"
                       placeholder="Contoh: 2023"
                       class="input-field w-full px-4 py-2.5 rounded-xl text-sm {{ $errors->has('angkatan') ? 'input-error' : '' }}">
                @error('angkatan')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            {{-- Divider --}}
            <div class="border-t border-gray-100 pt-1">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-4">Pilihan Divisi</p>

                {{-- Pilihan 1 --}}
                <div class="space-y-3 mb-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Pilihan Pertama <span class="text-red-400">*</span></label>
                        <input type="text" name="pilihan_pertama" value="{{ old('pilihan_pertama') }}"
                               placeholder="Nama divisi pilihan 1"
                               class="input-field w-full px-4 py-2.5 rounded-xl text-sm {{ $errors->has('pilihan_pertama') ? 'input-error' : '' }}">
                        @error('pilihan_pertama')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Alasan Memilih Pilihan 1 <span class="text-red-400">*</span></label>
                        <textarea name="alasan_pilihan_pertama" rows="3"
                                  placeholder="Jelaskan alasanmu memilih divisi ini..."
                                  class="input-field w-full px-4 py-2.5 rounded-xl text-sm resize-none {{ $errors->has('alasan_pilihan_pertama') ? 'input-error' : '' }}">{{ old('alasan_pilihan_pertama') }}</textarea>
                        @error('alasan_pilihan_pertama')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Pilihan 2 --}}
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Pilihan Kedua <span class="text-red-400">*</span></label>
                        <input type="text" name="pilihan_kedua" value="{{ old('pilihan_kedua') }}"
                               placeholder="Nama divisi pilihan 2"
                               class="input-field w-full px-4 py-2.5 rounded-xl text-sm {{ $errors->has('pilihan_kedua') ? 'input-error' : '' }}">
                        @error('pilihan_kedua')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Alasan Memilih Pilihan 2 <span class="text-red-400">*</span></label>
                        <textarea name="alasan_pilihan_kedua" rows="3"
                                  placeholder="Jelaskan alasanmu memilih divisi ini..."
                                  class="input-field w-full px-4 py-2.5 rounded-xl text-sm resize-none {{ $errors->has('alasan_pilihan_kedua') ? 'input-error' : '' }}">{{ old('alasan_pilihan_kedua') }}</textarea>
                        @error('alasan_pilihan_kedua')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            {{-- Upload Foto --}}
            <div class="border-t border-gray-100 pt-4">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Foto (Opsional)</label>
                <div class="relative">
                    <input type="file" name="foto" id="foto" accept="image/jpg,image/jpeg,image/png"
                           class="hidden" onchange="previewFoto(this)">
                    <label for="foto"
                           class="flex items-center gap-3 w-full px-4 py-3 rounded-xl border-2 border-dashed border-gray-200 cursor-pointer hover:border-primary-400 transition-colors">
                        <div class="w-8 h-8 rounded-lg bg-primary-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p id="foto-label" class="text-sm text-gray-500">Klik untuk pilih foto</p>
                            <p class="text-xs text-gray-300">JPG, JPEG, PNG — Maks. 2MB</p>
                        </div>
                    </label>
                    <img id="foto-preview" src="" alt="Preview" class="hidden mt-3 w-24 h-24 rounded-xl object-cover border border-gray-100">
                </div>
                @error('foto')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <button type="submit"
                    class="btn-primary w-full text-white font-semibold text-sm py-3 rounded-xl flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
                Kirim Pendaftaran
            </button>
        </form>
    </div>

    <p class="text-center text-sm text-gray-400 mt-5">
        Punya aspirasi?
        <a href="{{ route('mahasiswa.aspirasi') }}" class="text-primary font-medium hover:underline">Kirim di sini →</a>
    </p>
</div>
</section>

@push('scripts')
<script>
function previewFoto(input) {
    const label   = document.getElementById('foto-label');
    const preview = document.getElementById('foto-preview');
    if (input.files && input.files[0]) {
        label.textContent = input.files[0].name;
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection
