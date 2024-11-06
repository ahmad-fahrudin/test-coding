<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Kelas Controller Routes
    Route::controller(KelasController::class)->group(function () {
        Route::get('/kelas', 'index')->name('kelas.index');
        Route::get('kelas/data', 'getData')->name('kelas.data');
        Route::get('/kelas/create', 'create')->name('kelas.create');
        Route::post('/kelas', 'store')->name('kelas.store');
        Route::get('/kelas/edit/{id}', 'edit')->name('kelas.edit');
        Route::put('/kelas/{id}', 'update')->name('kelas.update');
        Route::get('/kelas/show/{id}', 'show')->name('kelas.show');
        Route::delete('/kelas/{id}', 'destroy')->name('kelas.destroy');
    });

    // Siswa Controller Routes
    Route::controller(SiswaController::class)->group(function () {
        Route::get('/siswa', 'index')->name('siswa.index');
        Route::get('/siswa/data', 'getData')->name('siswa.data');
        Route::get('/siswa/create', 'create')->name('siswa.create');
        Route::post('/siswa', 'store')->name('siswa.store');
        Route::get('/siswa/edit/{id}', 'edit')->name('siswa.edit');
        Route::put('/siswa/{id}', 'update')->name('siswa.update');
        Route::get('/siswa/show/{id}', 'show')->name('siswa.show');
        Route::delete('/siswa/{id}', 'destroy')->name('siswa.destroy');
    });
});

require __DIR__ . '/auth.php';
