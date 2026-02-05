<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\JenisSampahController;
use App\Http\Controllers\HadiahController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::prefix('admin')->group(function () {
    Route::get('/jenis-sampah', [JenisSampahController::class, 'index'])->name('jenis-sampah.index');
    Route::post('/jenis-sampah', [JenisSampahController::class, 'store'])->name('jenis-sampah.store');
    Route::put('/jenis-sampah/{id}', [JenisSampahController::class, 'update'])->name('jenis-sampah.update');
    Route::delete('/jenis-sampah/{id}', [JenisSampahController::class, 'destroy'])->name('jenis-sampah.destroy');
});

Route::get('/hadiah', [HadiahController::class, 'index'])
    ->name('hadiah.index');

Route::post('/hadiah', [HadiahController::class, 'store'])
    ->name('hadiah.store');

Route::post('/hadiah/{id}', [HadiahController::class, 'update'])
    ->name('hadiah.update');

Route::post('/hadiah/{id}/delete', [HadiahController::class, 'destroy'])
    ->name('hadiah.destroy');


Route::get('/kelola_user', function () {
    return view('kelola_user');
});

Route::get('/setoran', function () {
    return view('setoran');
});

Route::get('/persetujuan', function () {
    return view('persetujuan');
});

Route::get('/eco_admin', function () {
    return view('eco_admin');
});

Route::get('/poin_admin', function () {
    return view('poin_admin');
});

Route::get('/dashboard_admin', function () {
    return view('dashboard_admin');
});

