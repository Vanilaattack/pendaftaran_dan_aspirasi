<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private function adminExists(): bool
    {
        return User::whereNotNull('username')->exists();
    }

    // ── Setup (hanya muncul jika belum ada admin) ──────────────
    public function showSetup()
    {
        if ($this->adminExists()) {
            return redirect()->route('admin.login');
        }
        return view('admin.setup');
    }

    public function setup(Request $request)
    {
        if ($this->adminExists()) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'name'                  => 'required|string|max:255',
            'username'              => 'required|string|max:50|unique:users,username|alpha_dash',
            'password'              => 'required|string|min:6|confirmed',
        ], [
            'name.required'         => 'Nama wajib diisi.',
            'username.required'     => 'Username wajib diisi.',
            'username.unique'       => 'Username sudah digunakan.',
            'username.alpha_dash'   => 'Username hanya boleh huruf, angka, strip, dan underscore.',
            'password.required'     => 'Password wajib diisi.',
            'password.min'          => 'Password minimal 6 karakter.',
            'password.confirmed'    => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->username . '@admin.local',
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('web')->login($user);
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Akun admin berhasil dibuat. Selamat datang, ' . $user->name . '!');
    }

    // ── Login ──────────────────────────────────────────────────
    public function showLogin()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('admin.dashboard');
        }

        // Belum ada admin → arahkan ke setup dulu
        if (!$this->adminExists()) {
            return redirect()->route('admin.setup');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (Auth::guard('web')->attempt(
            ['username' => $request->username, 'password' => $request->password],
            $request->boolean('remember')
        )) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['username' => 'Username atau password salah.'])->onlyInput('username');
    }

    // ── Logout ─────────────────────────────────────────────────
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
