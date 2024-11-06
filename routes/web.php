<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Kelas Controller Routes
    Route::controller(KelasController::class)->group(function () {
        Route::get('/kelas', 'index')->name('kelas.index');
        Route::get('kelas/data', [KelasController::class, 'getData'])->name('kelas.data');
        Route::get('/kelas/create', 'create')->name('kelas.create');
        Route::post('/kelas', 'store')->name('kelas.store');
        Route::get('/kelas/edit/{id}', 'edit')->name('kelas.edit');
        Route::put('/kelas/{id}', 'update')->name('kelas.update');
        Route::get('/kelas/show/{id}', 'show')->name('kelas.show');
        Route::delete('/kelas/{id}', 'destroy')->name('kelas.destroy');
    });
});

require __DIR__ . '/auth.php';
