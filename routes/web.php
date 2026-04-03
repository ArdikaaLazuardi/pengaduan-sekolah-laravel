<?php

use App\Http\Controllers\Admin\AspirasiController as AdminAspirasiController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SiswaLoginController;
use App\Http\Controllers\Siswa\AspirasiController as SiswaAspirasiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Redirect Awal
|--------------------------------------------------------------------------
*/
Route::redirect('/', '/siswa/login');

/*
|--------------------------------------------------------------------------
| Guest Admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware('guest:admin')
    ->group(function () {
        Route::get('/login', [AdminLoginController::class, 'create'])->name('login');
        Route::post('/login', [AdminLoginController::class, 'store'])->name('authenticate');
    });

/*
|--------------------------------------------------------------------------
| Admin Area
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth:admin', 'admin'])
    ->group(function () {
        Route::get('/dashboard', [AdminAspirasiController::class, 'index'])->name('dashboard');

        Route::get('/aspirasi', [AdminAspirasiController::class, 'index'])->name('aspirasi.index');
        Route::get('/aspirasi/{aspirasi}', [AdminAspirasiController::class, 'show'])->name('aspirasi.show');
        Route::get('/aspirasi/{aspirasi}/edit', [AdminAspirasiController::class, 'edit'])->name('aspirasi.edit');
        Route::put('/aspirasi/{aspirasi}', [AdminAspirasiController::class, 'update'])->name('aspirasi.update');
        Route::delete('/aspirasi/{aspirasi}', [AdminAspirasiController::class, 'destroy'])->name('aspirasi.destroy');

        Route::post('/logout', [LogoutController::class, 'destroyAdmin'])->name('logout');
    });

/*
|--------------------------------------------------------------------------
| Guest Siswa
|--------------------------------------------------------------------------
*/
Route::prefix('siswa')
    ->name('siswa.')
    ->middleware('guest:siswa')
    ->group(function () {
        Route::get('/login', [SiswaLoginController::class, 'create'])->name('login');
        Route::post('/login', [SiswaLoginController::class, 'store'])->name('authenticate');
    });

/*
|--------------------------------------------------------------------------
| Siswa Area
|--------------------------------------------------------------------------
*/
Route::prefix('siswa')
    ->name('siswa.')
    ->middleware(['auth:siswa', 'siswa'])
    ->group(function () {
        Route::get('/dashboard', [SiswaAspirasiController::class, 'index'])->name('dashboard');

        Route::get('/riwayat', [SiswaAspirasiController::class, 'index'])->name('aspirasi.index');

        Route::resource('aspirasi', SiswaAspirasiController::class)
            ->except(['index']);

        Route::post('/logout', [LogoutController::class, 'destroySiswa'])->name('logout');
    });