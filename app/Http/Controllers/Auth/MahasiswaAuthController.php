<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MahasiswaAuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('mahasiswa')->check()) {
            return redirect()->route('mahasiswa.pendaftaran');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nim'      => 'required|string',
            'password' => 'required|string',
        ], [
            'nim.required'      => 'NIM wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();

        if ($mahasiswa && Hash::check($request->password, $mahasiswa->password)) {
            Auth::guard('mahasiswa')->login($mahasiswa, $request->boolean('remember'));
            $request->session()->regenerate();
            return redirect()->route('mahasiswa.pendaftaran');
        }

        return back()->withErrors(['nim' => 'NIM atau password salah.'])->onlyInput('nim');
    }

    public function logout(Request $request)
    {
        Auth::guard('mahasiswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // Registrasi akun mahasiswa baru
    public function showRegister()
    {
        if (Auth::guard('mahasiswa')->check()) {
            return redirect()->route('mahasiswa.pendaftaran');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama'                  => 'required|string|max:255',
            'nim'                   => 'required|string|max:50|unique:mahasiswa,nim',
            'password'              => 'required|string|min:6|confirmed',
        ], [
            'nama.required'         => 'Nama wajib diisi.',
            'nim.required'          => 'NIM wajib diisi.',
            'nim.unique'            => 'NIM sudah terdaftar.',
            'password.required'     => 'Password wajib diisi.',
            'password.min'          => 'Password minimal 6 karakter.',
            'password.confirmed'    => 'Konfirmasi password tidak cocok.',
        ]);

        $mahasiswa = Mahasiswa::create([
            'nama'     => $request->nama,
            'nim'      => $request->nim,
            'password' => $request->password,
        ]);

        Auth::guard('mahasiswa')->login($mahasiswa);
        $request->session()->regenerate();

        return redirect()->route('mahasiswa.pendaftaran')
            ->with('success', 'Akun berhasil dibuat. Selamat datang, ' . $mahasiswa->nama . '!');
    }
}
