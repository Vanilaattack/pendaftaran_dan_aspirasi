@extends('layout')
@section('title', 'Kirim Aspirasi — Himpunan Mahasiswa')

@section('content')
<section class="py-12 sm:py-16">
    <div class="max-w-xl mx-auto px-4 sm:px-6">

        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-primary mb-3 shadow-sm">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-800">Form Aspirasi</h2>
            <p class="text-gray-400 text-sm mt-1">Sampaikan aspirasimu dengan jelas dan sopan</p>
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

            <form action="{{ route('mahasiswa.aspirasi.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Nama Pengirim <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="nama_pengirim" value="{{ old('nama_pengirim') }}"
                           placeholder="Nama kamu (boleh anonim)"
                           class="input-field w-full px-4 py-2.5 rounded-xl text-sm {{ $errors->has('nama_pengirim') ? 'input-error' : '' }}">
                    @error('nama_pengirim')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Judul Aspirasi <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="judul_aspirasi" value="{{ old('judul_aspirasi') }}"
                           placeholder="Ringkasan singkat aspirasimu"
                           class="input-field w-full px-4 py-2.5 rounded-xl text-sm {{ $errors->has('judul_aspirasi') ? 'input-error' : '' }}">
                    @error('judul_aspirasi')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Pesan <span class="text-red-400">*</span>
                    </label>
                    <textarea name="pesan" rows="5"
                              placeholder="Tuliskan aspirasi, saran, atau kritikmu secara detail..."
                              class="input-field w-full px-4 py-2.5 rounded-xl text-sm resize-none {{ $errors->has('pesan') ? 'input-error' : '' }}">{{ old('pesan') }}</textarea>
                    @error('pesan')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="btn-primary w-full text-white font-semibold text-sm py-3 rounded-xl mt-1
                               flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    Kirim Aspirasi
                </button>
            </form>
        </div>

    </div>
</section>
@endsection
