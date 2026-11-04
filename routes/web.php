<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');
    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.submit');
});

Route::middleware('auth')->group(function () {
    Route::get('/', fn () => view('dashboard'))->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Pengelolaan surat hanya untuk petugas
    // Daftarkan dahulu agar create tidak dianggap sebagai ID
    Route::resource('surat-masuk', SuratMasukController::class)
        ->except(['index', 'show'])
        ->parameters(['surat-masuk' => 'id'])
        ->middleware('can:manage-letters');

    // Daftar dan detail surat bisa dibuka semua pengguna login
    Route::resource('surat-masuk', SuratMasukController::class)
        ->parameters(['surat-masuk' => 'id']);
        
    // Surat Keluar: Pembaca & Petugas (index & show)[cite: 13, 15]
    Route::resource('surat-keluar', SuratKeluarController::class)
        ->parameters(['surat-keluar' => 'id']);

    // Surat Keluar: Hanya Petugas (create, store, edit, update, destroy)[cite: 13, 15]
    Route::resource('surat-keluar', SuratKeluarController::class)
        ->except(['index', 'show'])
        ->parameters(['surat-keluar' => 'id'])
        ->middleware('can:manage-letters');
});