<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Auth\MahasiswaAuthController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AUTH MAHASISWA — Guest
|--------------------------------------------------------------------------
*/
Route::middleware('guest:mahasiswa')->group(function () {
    Route::get('/',         [MahasiswaAuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [MahasiswaAuthController::class, 'login'])->name('login.post');
    Route::get('/daftar-akun',  [MahasiswaAuthController::class, 'showRegister'])->name('register');
    Route::post('/daftar-akun', [MahasiswaAuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [MahasiswaAuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| MAHASISWA — Protected (guard: mahasiswa)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:mahasiswa')->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/pendaftaran',  [RegistrationController::class, 'showPendaftaran'])->name('pendaftaran');
    Route::post('/pendaftaran', [RegistrationController::class, 'storePendaftaran'])->name('pendaftaran.store');
    Route::get('/aspirasi',     [RegistrationController::class, 'showAspirasi'])->name('aspirasi');
    Route::post('/aspirasi',    [RegistrationController::class, 'storeAspirasi'])->name('aspirasi.store');
});

/*
|--------------------------------------------------------------------------
| ADMIN — Auth
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/setup',  [AdminAuthController::class, 'showSetup'])->name('setup');
        Route::post('/setup', [AdminAuthController::class, 'setup'])->name('setup.post');
        Route::get('/login',  [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    });

    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard',              [AdminController::class, 'dashboard'])->name('dashboard');
        Route::delete('/registrations/{id}',  [AdminController::class, 'deleteRegistration'])->name('registrations.delete');
        Route::delete('/aspirations/{id}',    [AdminController::class, 'deleteAspiration'])->name('aspirations.delete');
    });
});
