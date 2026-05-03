<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use App\Models\Registration;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    // Halaman form pendaftaran
    public function index()
    {
        return view('mahasiswa.index');
    }

    // Simpan data pendaftaran
    public function storeRegistration(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'                   => 'required|string|max:255',
            'nim'                            => 'required|string|max:50|unique:registrations,nim',
            'angkatan'                       => 'required|string|max:10',
            'pilihan_pertama'                => 'required|string|max:255',
            'alasan_memilih_pilihan_pertama' => 'required|string|max:2000',
            'pilihan_kedua'                  => 'required|string|max:255',
            'alasan_memilih_pilihan_kedua'   => 'required|string|max:2000',
        ], [
            'nama_lengkap.required'                   => 'Nama lengkap wajib diisi.',
            'nim.required'                            => 'NIM wajib diisi.',
            'nim.unique'                              => 'NIM ini sudah terdaftar.',
            'angkatan.required'                       => 'Angkatan wajib diisi.',
            'pilihan_pertama.required'                => 'Pilihan pertama wajib diisi.',
            'alasan_memilih_pilihan_pertama.required' => 'Alasan memilih pilihan 1 wajib diisi.',
            'pilihan_kedua.required'                  => 'Pilihan kedua wajib diisi.',
            'alasan_memilih_pilihan_kedua.required'   => 'Alasan memilih pilihan 2 wajib diisi.',
        ]);

        Registration::create($validated);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Pendaftaran berhasil dikirim! Kami akan segera menghubungi kamu.');
    }

    // Halaman form aspirasi
    public function aspirasi()
    {
        return view('mahasiswa.aspirasi');
    }

    // Simpan data aspirasi
    public function storeAspirasi(Request $request)
    {
        $validated = $request->validate([
            'nama_pengirim' => 'required|string|max:255',
            'judul_aspirasi'=> 'required|string|max:255',
            'pesan'         => 'required|string|max:3000',
        ], [
            'nama_pengirim.required'  => 'Nama pengirim wajib diisi.',
            'judul_aspirasi.required' => 'Judul aspirasi wajib diisi.',
            'pesan.required'          => 'Pesan aspirasi wajib diisi.',
        ]);

        Aspiration::create($validated);

        return redirect()->route('mahasiswa.aspirasi')
            ->with('success', 'Aspirasi kamu berhasil terkirim! Terima kasih atas masukannya.');
    }
}
