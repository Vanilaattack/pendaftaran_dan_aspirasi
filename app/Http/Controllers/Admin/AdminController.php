<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use App\Models\Registration;
use Illuminate\Http\Request;

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
        Registration::findOrFail($id)->delete();

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
