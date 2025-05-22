<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PendaftaranController;
use App\Http\Controllers\Export;
use App\Http\Controllers\FilteringController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

Route::middleware(CheckRole::class)->prefix('admin')->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
  Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran');
  Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'show'])->name('pendaftaran.show');
  Route::delete('/pendaftaran/{id}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
  Route::put('/updateStatus/{id}', [PendaftaranController::class, 'updateStatus'])->name('admin.updateStatus');

  Route::get('/data-siswa/{no_pendaftaran}/pdf', [PendaftaranController::class, 'lembarVerifikasi'])->name('data.siswa.pdf');

  Route::get('/export', [Export::class, 'index'])->name('export');
  Route::get('/export/action', [Export::class, 'exportSiswa'])->name('export.action');
  Route::get('/berkas-by-jalur/{id}', [Export::class, 'getByJalur']);

  Route::get('/filtering', [FilteringController::class, 'index'])->name('filtering');
});
