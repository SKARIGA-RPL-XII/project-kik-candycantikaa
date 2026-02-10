<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\JenisSampahController;
use App\Http\Controllers\HadiahController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SetoranController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\RiwayatSetorController;
use App\Http\Controllers\UserTukarPoinController;


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
    Route::put('/users/{id_user}', [UserController::class, 'update'])
        ->name('admin.users.update');
    Route::delete('/admin/users/{id_user}', [UserController::class, 'destroy'])
        ->name('admin.users.destroy');

});

Route::get('/hadiah', [HadiahController::class, 'index'])
    ->name('hadiah.index');

Route::post('/hadiah', [HadiahController::class, 'store'])
    ->name('hadiah.store');

Route::post('/hadiah/{id}', [HadiahController::class, 'update'])
    ->name('hadiah.update');

Route::post('/hadiah/{id}/delete', [HadiahController::class, 'destroy'])
    ->name('hadiah.destroy');


Route::get('/kelola_user', [UserController::class, 'index'])
    ->name('kelola_user');

Route::get('/setoran', [SetoranController::class, 'index'])
    ->name('setoran.index');

Route::post('/setoran', [SetoranController::class, 'store'])
    ->name('setoran.store');

Route::get('/setoran/{id}', [SetoranController::class, 'show'])
    ->name('setoran.show');

Route::put('/setoran/{id}', [SetoranController::class, 'update'])
    ->name('setoran.update');

Route::delete('/setoran/{id}', [SetoranController::class, 'destroy'])
    ->name('setoran.destroy');

Route::get('/persetujuan', function () {
    return view('persetujuan');
});

Route::get('/eco_admin', function () {
    return view('eco_admin');
});

Route::get('/poin_admin', function () {
    return view('poin_admin');
});

Route::get('/tukar_poin_user', function () {
    return view('tukar_poin_user');
});

Route::middleware(['checkLogin', 'admin'])->group(function () {
    Route::get('/dashboard_admin', [AdminController::class, 'index']);
});

Route::middleware(['checkLogin', 'user'])->group(function () {
    Route::get('/dashboard_user', [UserDashboardController::class, 'index']);

    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::get('/riwayat_setor', [RiwayatSetorController::class, 'index'])->name('riwayat_setor');
    Route::get('/tukar_poin_user', [UserTukarPoinController::class, 'index'])
        ->name('tukar_poin_user');
    Route::post('/tukar-poin', [UserTukarPoinController::class, 'tukar'])
        ->name('tukar.poin');
    Route::post('/tukar-poin', [UserTukarPoinController::class, 'tukar'])->name('tukar.poin');
});