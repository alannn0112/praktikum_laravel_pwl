<?php

use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

 //route dasar
 /*Route::get('/surat-masuk', function () {
    return 'Halaman Surat Masuk';
});

 //route dengan parameter
 Route::get('/surat-masuk/{id}', function ($id) {
    return 'Detail surat masuk dengan ID:' .$id;
});*/

//named route
/*Route::get('/surat-masuk', function () {
    return 'Halaman Surat Masuk';
})->name('surat-masuk.index');

Route::get('/surat-masuk/{id}', function ($id) {
    return 'Detail surat masuk dengan ID:' .$id;
})->name('surat-masuk.show');*/

route::get('/surat-masuk', [SuratMasukController::class, 'index'])
    ->name('surat-masuk.index');
route::get('/surat-masuk/{id}', [SuratMasukController::class, 'show'])
    ->name('surat-masuk.show');

route::get('/surat-keluar', [SuratKeluarController::class, 'index'])
    ->name('surat-keluar.index');
route::get('/surat-keluar/{id}', [SuratKeluarController::class, 'show'])
    ->name('surat-keluar.show');