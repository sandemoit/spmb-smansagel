<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PendaftaranController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
  Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran');
  Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'show'])->name('pendaftaran.show');
  Route::delete('/pendaftaran/{id}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
  Route::put('/updateStatus/{id}', [PendaftaranController::class, 'updateStatus'])->name('admin.updateStatus');
});
