<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use App\Models\Registration;

class AdminController extends Controller
{
    public function dashboard()
    {
        $registrations = Registration::orderByDesc('created_at')->get();
        $aspirations   = Aspiration::orderByDesc('created_at')->get();

        return view('admin.dashboard', compact('registrations', 'aspirations'));
    }

    public function deleteRegistration($id)
    {
        $reg = Registration::findOrFail($id);

        // Hapus file foto jika ada
        if ($reg->foto && file_exists(public_path($reg->foto))) {
            unlink(public_path($reg->foto));
        }

        $reg->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Data pendaftaran berhasil dihapus.');
    }

    public function deleteAspiration($id)
    {
        Aspiration::findOrFail($id)->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Data aspirasi berhasil dihapus.');
    }
}
