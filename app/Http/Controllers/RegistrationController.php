<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function showPendaftaran()
    {
        return view('mahasiswa.form_pendaftaran');
    }

    public function storePendaftaran(Request $request)
    {
        $validated = $request->validate([
            'nama'                   => 'required|string|max:255',
            'nim'                    => 'required|string|max:50',
            'angkatan'               => 'required|string|max:10',
            'pilihan_pertama'        => 'required|string|max:255',
            'alasan_pilihan_pertama' => 'required|string|max:2000',
            'pilihan_kedua'          => 'required|string|max:255',
            'alasan_pilihan_kedua'   => 'required|string|max:2000',
            'foto'                   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama.required'                   => 'Nama wajib diisi.',
            'nim.required'                    => 'NIM wajib diisi.',
            'angkatan.required'               => 'Angkatan wajib diisi.',
            'pilihan_pertama.required'        => 'Pilihan pertama wajib diisi.',
            'alasan_pilihan_pertama.required' => 'Alasan pilihan 1 wajib diisi.',
            'pilihan_kedua.required'          => 'Pilihan kedua wajib diisi.',
            'alasan_pilihan_kedua.required'   => 'Alasan pilihan 2 wajib diisi.',
            'foto.image'                      => 'File harus berupa gambar.',
            'foto.mimes'                      => 'Format foto: jpg, jpeg, atau png.',
            'foto.max'                        => 'Ukuran foto maksimal 2MB.',
        ]);

        // Upload foto
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $file     = $request->file('foto');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('uploads/pendaftar'), $filename);
            $fotoPath = 'uploads/pendaftar/' . $filename;
        }

        Registration::create([
            'nama'                   => $validated['nama'],
            'nim'                    => $validated['nim'],
            'angkatan'               => $validated['angkatan'],
            'pilihan_pertama'        => $validated['pilihan_pertama'],
            'alasan_pilihan_pertama' => $validated['alasan_pilihan_pertama'],
            'pilihan_kedua'          => $validated['pilihan_kedua'],
            'alasan_pilihan_kedua'   => $validated['alasan_pilihan_kedua'],
            'foto'                   => $fotoPath,
        ]);

        return redirect()->route('mahasiswa.pendaftaran')
            ->with('success', 'Pendaftaran berhasil dikirim!');
    }

    public function showAspirasi()
    {
        return view('mahasiswa.form_aspirasi');
    }

    public function storeAspirasi(Request $request)
    {
        $request->validate([
            'nama_pengirim' => 'required|string|max:255',
            'judul'         => 'required|string|max:255',
            'isi_aspirasi'  => 'required|string|max:3000',
        ], [
            'nama_pengirim.required' => 'Nama/inisial wajib diisi.',
            'judul.required'         => 'Judul aspirasi wajib diisi.',
            'isi_aspirasi.required'  => 'Isi aspirasi wajib diisi.',
        ]);

        Aspiration::create($request->only('nama_pengirim', 'judul', 'isi_aspirasi'));

        return redirect()->route('mahasiswa.aspirasi')
            ->with('success', 'Aspirasi berhasil dikirim!');
    }
}
