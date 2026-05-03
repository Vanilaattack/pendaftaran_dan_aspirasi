<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Mahasiswa / Guest)
|--------------------------------------------------------------------------
*/
Route::get('/', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::post('/daftar', [MahasiswaController::class, 'storeRegistration'])->name('mahasiswa.daftar');

Route::get('/aspirasi', [MahasiswaController::class, 'aspirasi'])->name('mahasiswa.aspirasi');
Route::post('/aspirasi', [MahasiswaController::class, 'storeAspirasi'])->name('mahasiswa.aspirasi.store');

/*
|--------------------------------------------------------------------------
| Admin Auth Routes (Guest only)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('guest');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Admin Protected Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::delete('/registrations/{id}', [AdminController::class, 'deleteRegistration'])->name('registrations.delete');
        Route::delete('/aspirations/{id}', [AdminController::class, 'deleteAspiration'])->name('aspirations.delete');
    });
});
