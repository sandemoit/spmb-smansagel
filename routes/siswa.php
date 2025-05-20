<?php

use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

Route::prefix('siswa')->middleware('auth')->group(function () {
    // Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/biodata', [SiswaController::class, 'biodata'])->name('siswa.biodata');
    Route::put('/biodata', [SiswaController::class, 'biodataUpdate'])->name('siswa.biodata.update');

    Route::get('/berkas', [SiswaController::class, 'berkas'])->name('siswa.berkas');
    Route::post('/berkas', [SiswaController::class, 'uploadBerkas'])->name('siswa.berkas.upload');

    Route::get('/nilai', [SiswaController::class, 'nilai'])->name('siswa.nilai');
    Route::post('/nilai', [SiswaController::class, 'nilaiStore'])->name('siswa.nilai.store');

    Route::get('/lembar-verifikasi', [SiswaController::class, 'lembarVerifikasi'])->name('generate.lembarVerifikasi');
    // Route::delete('/biodata/{siswa}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
});
