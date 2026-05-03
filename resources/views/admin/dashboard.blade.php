<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin — Himpunan Mahasiswa Informatika</title>
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
        .tab-btn { transition: color .15s, border-color .15s; border-bottom: 2.5px solid transparent; }
        .tab-btn.active { color: #25B1E0; border-bottom-color: #25B1E0; }
        .tab-btn:not(.active) { color: #9ca3af; }
        .tab-btn:not(.active):hover { color: #6b7280; }
        .tab-panel { display: none; }
        .tab-panel.active { display: block; }
        tbody tr { transition: background .1s; }
        tbody tr:hover { background: #f8fdff; }
        .overflow-x-auto::-webkit-scrollbar { height: 4px; }
        .overflow-x-auto::-webkit-scrollbar-thumb { background: #25B1E0; border-radius: 4px; }
        /* Modal */
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.45); z-index: 100; align-items: center; justify-content: center; padding: 1rem; }
        .modal-overlay.open { display: flex; }
        .modal-box { background: #fff; border-radius: 1.25rem; width: 100%; max-width: 520px; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 60px rgba(0,0,0,.15); }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">


{{-- Toast --}}
@if(session('success'))
<div id="toast" class="fixed top-4 right-4 z-50 max-w-xs">
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

{{-- Header --}}
<header class="bg-white border-b border-gray-100 sticky top-0 z-40">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 h-14 flex items-center justify-between">
        <div class="flex items-center gap-2.5">
            <div class="w-7 h-7 rounded-lg bg-primary flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                </svg>
            </div>
            <span class="font-semibold text-gray-800 text-sm">Himpunan Mahasiswa Informatika</span>
        </div>
        <div class="flex items-center gap-2">
    
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="inline-flex items-center gap-1.5 text-xs text-red-500 hover:bg-red-50 px-3 py-1.5 rounded-lg transition-colors font-medium">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    
                </button>
            </form>
        </div>
    </div>
</header>

<main class="max-w-5xl mx-auto px-4 sm:px-6 py-8 space-y-6">

    {{-- Tab Card --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        {{-- Tab Nav --}}
        <div class="flex border-b border-gray-100 px-6 gap-6">
            <button onclick="switchTab('pendaftaran')" id="tab-pendaftaran"
                    class="tab-btn active py-4 text-sm font-semibold flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Pendaftaran
                <span class="bg-primary text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $registrations->count() }}</span>
            </button>
            <button onclick="switchTab('aspirasi')" id="tab-aspirasi"
                    class="tab-btn py-4 text-sm font-semibold flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                Aspirasi
                <span id="badge-aspirasi" class="bg-gray-100 text-gray-500 text-xs font-bold px-2 py-0.5 rounded-full">{{ $aspirations->count() }}</span>
            </button>
        </div>

        {{-- ===== PANEL PENDAFTARAN ===== --}}
        <div id="panel-pendaftaran" class="tab-panel active">
            @if($registrations->isEmpty())
                <div class="py-16 text-center">
                    <div class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center mx-auto mb-3">
                        <svg class="w-7 h-7 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <p class="text-sm text-gray-400 font-medium">Belum ada data pendaftaran</p>
                    <p class="text-xs text-gray-300 mt-1">Data akan muncul setelah mahasiswa mengisi form pendaftaran</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 text-left">
                                <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide w-10">#</th>
                                <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Nama Lengkap</th>
                                <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">NIM</th>
                                <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Angkatan</th>
                                <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Pilihan Pertama</th>
                                <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Alasan Memilih Pilihan 1</th>
                                <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Pilihan Kedua</th>
                                <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Alasan Memilih Pilihan 2</th>
                                <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Tanggal Daftar</th>
                                <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($registrations as $i => $reg)
                            <tr>
                                <td class="px-5 py-3.5 text-gray-300 text-xs">{{ $i + 1 }}</td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                            {{ strtoupper(substr($reg->nama_lengkap, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $reg->nama_lengkap }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="bg-primary-50 text-primary-700 text-xs font-semibold px-2.5 py-1 rounded-lg">{{ $reg->nim }}</span>
                                </td>
                                <td class="px-5 py-3.5 text-gray-600 text-sm">{{ $reg->angkatan ?? '-' }}</td>
                                <td class="px-5 py-3.5 text-gray-600 text-sm">{{ $reg->pilihan_pertama ?? '-' }}</td>
                                <td class="px-5 py-3.5 text-gray-400 text-sm max-w-[160px]">
                                    <p class="truncate">{{ $reg->alasan_memilih_pilihan_pertama ?? '-' }}</p>
                                </td>
                                <td class="px-5 py-3.5 text-gray-600 text-sm">{{ $reg->pilihan_kedua ?? '-' }}</td>
                                <td class="px-5 py-3.5 text-gray-400 text-sm max-w-[160px]">
                                    <p class="truncate">{{ $reg->alasan_memilih_pilihan_kedua ?? '-' }}</p>
                                </td>
                                <td class="px-5 py-3.5 text-gray-400 text-xs whitespace-nowrap">
                                    {{ $reg->created_at ? $reg->created_at->format('d M Y, H:i') : '-' }}
                                </td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-1">
                                        {{-- Tombol Lihat Detail --}}
                                        <button type="button"
                                                onclick="showDetailReg({{ $reg->id }})"
                                                class="inline-flex items-center gap-1 text-xs text-primary-600 hover:bg-primary-50 px-2.5 py-1.5 rounded-lg transition-colors font-medium">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Detail
                                        </button>
                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('admin.registrations.delete', $reg->id) }}" method="POST"
                                              onsubmit="return confirm('Hapus data pendaftaran {{ addslashes($reg->nama_lengkap) }}?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1 text-xs text-red-400 hover:text-red-600 hover:bg-red-50 px-2.5 py-1.5 rounded-lg transition-colors font-medium">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- ===== PANEL ASPIRASI ===== --}}
        <div id="panel-aspirasi" class="tab-panel">
            @if($aspirations->isEmpty())
                <div class="py-16 text-center">
                    <div class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center mx-auto mb-3">
                        <svg class="w-7 h-7 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <p class="text-sm text-gray-400 font-medium">Belum ada aspirasi masuk</p>
                    <p class="text-xs text-gray-300 mt-1">Data akan muncul setelah mahasiswa mengirim aspirasi</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 text-left">
                                <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide w-10">#</th>
                                <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Pengirim</th>
                                <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Judul Aspirasi</th>
                                <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Tanggal Kirim</th>
                                <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($aspirations as $i => $asp)
                            <tr>
                                <td class="px-5 py-3.5 text-gray-300 text-xs">{{ $i + 1 }}</td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary text-xs font-bold flex-shrink-0">
                                            {{ strtoupper(substr($asp->nama_pengirim, 0, 1)) }}
                                        </div>
                                        <p class="font-semibold text-gray-800">{{ $asp->nama_pengirim }}</p>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5 font-medium text-gray-700">{{ $asp->judul_aspirasi }}</td>
                                <td class="px-5 py-3.5 text-gray-400 text-xs whitespace-nowrap">
                                    {{ $asp->created_at ? $asp->created_at->format('d M Y, H:i') : '-' }}
                                </td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-1">
                                        {{-- Tombol Lihat Pesan --}}
                                        <button type="button"
                                                onclick="showDetailAsp({{ $asp->id }})"
                                                class="inline-flex items-center gap-1 text-xs text-primary-600 hover:bg-primary-50 px-2.5 py-1.5 rounded-lg transition-colors font-medium">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Baca
                                        </button>
                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('admin.aspirations.delete', $asp->id) }}" method="POST"
                                              onsubmit="return confirm('Hapus aspirasi dari {{ addslashes($asp->nama_pengirim) }}?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1 text-xs text-red-400 hover:text-red-600 hover:bg-red-50 px-2.5 py-1.5 rounded-lg transition-colors font-medium">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>{{-- end card --}}
</main>

{{-- ===== MODAL DETAIL PENDAFTARAN ===== --}}
<div id="modal-reg" class="modal-overlay" onclick="closeModal('modal-reg', event)">
    <div class="modal-box">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-primary flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 text-sm">Detail Pendaftaran</h3>
                    <p class="text-xs text-gray-400">Data lengkap pendaftar</p>
                </div>
            </div>
            <button onclick="document.getElementById('modal-reg').classList.remove('open')"
                    class="w-8 h-8 rounded-lg hover:bg-gray-100 flex items-center justify-center text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="p-6 space-y-4">
            <div class="flex items-center gap-3 pb-4 border-b border-gray-50">
                <div id="reg-avatar" class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white text-lg font-bold flex-shrink-0"></div>
                <div>
                    <p id="reg-nama" class="font-bold text-gray-800 text-base"></p>
                    <p class="text-xs text-gray-400 mt-0.5">Pendaftar Anggota</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div class="bg-gray-50 rounded-xl p-3">
                    <p class="text-xs text-gray-400 mb-1">NIM</p>
                    <p id="reg-nim" class="text-sm font-semibold text-primary-700"></p>
                </div>
                <div class="bg-gray-50 rounded-xl p-3">
                    <p class="text-xs text-gray-400 mb-1">Angkatan</p>
                    <p id="reg-angkatan" class="text-sm font-semibold text-gray-800"></p>
                </div>
            </div>
            <div class="bg-gray-50 rounded-xl p-3">
                <p class="text-xs text-gray-400 mb-1">Tanggal Daftar</p>
                <p id="reg-tanggal" class="text-sm font-semibold text-gray-800"></p>
            </div>
            <div class="bg-primary-50 rounded-xl p-4">
                <p class="text-xs font-semibold text-primary-600 mb-1">Pilihan Pertama</p>
                <p id="reg-pilihan1" class="text-sm font-bold text-gray-800 mb-2"></p>
                <p class="text-xs font-semibold text-primary-600 mb-1">Alasan Memilih Pilihan 1</p>
                <p id="reg-alasan1" class="text-sm text-gray-700 leading-relaxed whitespace-pre-wrap"></p>
            </div>
            <div class="bg-gray-50 rounded-xl p-4">
                <p class="text-xs font-semibold text-gray-500 mb-1">Pilihan Kedua</p>
                <p id="reg-pilihan2" class="text-sm font-bold text-gray-800 mb-2"></p>
                <p class="text-xs font-semibold text-gray-500 mb-1">Alasan Memilih Pilihan 2</p>
                <p id="reg-alasan2" class="text-sm text-gray-700 leading-relaxed whitespace-pre-wrap"></p>
            </div>
        </div>
    </div>
</div>

{{-- ===== MODAL DETAIL ASPIRASI ===== --}}
<div id="modal-asp" class="modal-overlay" onclick="closeModal('modal-asp', event)">
    <div class="modal-box">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-primary-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 text-sm">Detail Aspirasi</h3>
                    <p class="text-xs text-gray-400">Pesan lengkap dari pengirim</p>
                </div>
            </div>
            <button onclick="document.getElementById('modal-asp').classList.remove('open')"
                    class="w-8 h-8 rounded-lg hover:bg-gray-100 flex items-center justify-center text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="p-6 space-y-4">
            <div class="flex items-center gap-3 pb-4 border-b border-gray-50">
                <div id="asp-avatar" class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center text-primary text-lg font-bold flex-shrink-0"></div>
                <div>
                    <p id="asp-nama" class="font-bold text-gray-800 text-base"></p>
                    <p class="text-xs text-gray-400 mt-0.5">Pengirim Aspirasi</p>
                </div>
            </div>
            <div class="bg-gray-50 rounded-xl p-3">
                <p class="text-xs text-gray-400 mb-1">Tanggal Kirim</p>
                <p id="asp-tanggal" class="text-sm font-semibold text-gray-800"></p>
            </div>
            <div class="bg-gray-50 rounded-xl p-3">
                <p class="text-xs text-gray-400 mb-1">Judul Aspirasi</p>
                <p id="asp-judul" class="text-sm font-bold text-gray-800"></p>
            </div>
            <div class="bg-primary-50 rounded-xl p-4">
                <p class="text-xs font-semibold text-primary-600 mb-2">Isi Pesan</p>
                <p id="asp-pesan" class="text-sm text-gray-700 leading-relaxed whitespace-pre-wrap"></p>
            </div>
        </div>
    </div>
</div>

{{-- Data JSON untuk modal --}}
<script>
const regData = {
    @foreach($registrations as $reg)
    {{ $reg->id }}: {
        nama: @json($reg->nama_lengkap),
        nim: @json($reg->nim),
        angkatan: @json($reg->angkatan ?? '-'),
        pilihan1: @json($reg->pilihan_pertama ?? '-'),
        alasan1: @json($reg->alasan_memilih_pilihan_pertama ?? '-'),
        pilihan2: @json($reg->pilihan_kedua ?? '-'),
        alasan2: @json($reg->alasan_memilih_pilihan_kedua ?? '-'),
        tanggal: @json($reg->created_at ? $reg->created_at->format('d M Y, H:i') : '-'),
    },
    @endforeach
};

const aspData = {
    @foreach($aspirations as $asp)
    {{ $asp->id }}: {
        nama: @json($asp->nama_pengirim),
        judul: @json($asp->judul_aspirasi),
        pesan: @json($asp->pesan),
        tanggal: @json($asp->created_at ? $asp->created_at->format('d M Y, H:i') : '-'),
    },
    @endforeach
};

function showDetailReg(id) {
    const d = regData[id];
    if (!d) return;
    document.getElementById('reg-avatar').textContent = d.nama.charAt(0).toUpperCase();
    document.getElementById('reg-nama').textContent = d.nama;
    document.getElementById('reg-nim').textContent = d.nim;
    document.getElementById('reg-angkatan').textContent = d.angkatan;
    document.getElementById('reg-tanggal').textContent = d.tanggal;
    document.getElementById('reg-pilihan1').textContent = d.pilihan1;
    document.getElementById('reg-alasan1').textContent = d.alasan1;
    document.getElementById('reg-pilihan2').textContent = d.pilihan2;
    document.getElementById('reg-alasan2').textContent = d.alasan2;
    document.getElementById('modal-reg').classList.add('open');
}

function showDetailAsp(id) {
    const d = aspData[id];
    if (!d) return;
    document.getElementById('asp-avatar').textContent = d.nama.charAt(0).toUpperCase();
    document.getElementById('asp-nama').textContent = d.nama;
    document.getElementById('asp-tanggal').textContent = d.tanggal;
    document.getElementById('asp-judul').textContent = d.judul;
    document.getElementById('asp-pesan').textContent = d.pesan;
    document.getElementById('modal-asp').classList.add('open');
}

function closeModal(id, event) {
    if (event.target === document.getElementById(id)) {
        document.getElementById(id).classList.remove('open');
    }
}

function switchTab(name) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('panel-' + name).classList.add('active');
    document.getElementById('tab-' + name).classList.add('active');
    const badge = document.getElementById('badge-aspirasi');
    if (name === 'aspirasi') {
        badge.className = 'bg-primary text-white text-xs font-bold px-2 py-0.5 rounded-full';
    } else {
        badge.className = 'bg-gray-100 text-gray-500 text-xs font-bold px-2 py-0.5 rounded-full';
    }
}

// Tutup modal dengan tombol Escape
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        document.getElementById('modal-reg').classList.remove('open');
        document.getElementById('modal-asp').classList.remove('open');
    }
});
</script>

</body>
</html>
