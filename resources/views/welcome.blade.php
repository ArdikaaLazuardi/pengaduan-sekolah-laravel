<?php

use App\Http\Controllers\Admin\AspirasiController as AdminAspirasiController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SiswaLoginController;
use App\Http\Controllers\Siswa\AspirasiController as SiswaAspirasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('siswa.login');
});

Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'create'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'store'])->name('authenticate');
});

Route::middleware(['auth:admin', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminAspirasiController::class, 'index'])->name('dashboard');
    Route::get('/aspirasi', [AdminAspirasiController::class, 'index'])->name('aspirasi.index');
    Route::get('/aspirasi/{aspirasi}', [AdminAspirasiController::class, 'show'])->name('aspirasi.show');
    Route::get('/aspirasi/{aspirasi}/edit', [AdminAspirasiController::class, 'edit'])->name('aspirasi.edit');
    Route::put('/aspirasi/{aspirasi}', [AdminAspirasiController::class, 'update'])->name('aspirasi.update');
    Route::delete('/aspirasi/{aspirasi}', [AdminAspirasiController::class, 'destroy'])->name('aspirasi.destroy');
    Route::post('/logout', [LogoutController::class, 'destroyAdmin'])->name('logout');
});

Route::middleware('guest:siswa')->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/login', [SiswaLoginController::class, 'create'])->name('login');
    Route::post('/login', [SiswaLoginController::class, 'store'])->name('authenticate');
});

Route::middleware(['auth:siswa', 'siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', [SiswaAspirasiController::class, 'index'])->name('dashboard');
    Route::resource('aspirasi', SiswaAspirasiController::class)->except(['index'])->parameters([
        'aspirasi' => 'aspirasi',
    ]);
    Route::get('/riwayat', [SiswaAspirasiController::class, 'index'])->name('aspirasi.index');
    Route::post('/logout', [LogoutController::class, 'destroySiswa'])->name('logout');
});
