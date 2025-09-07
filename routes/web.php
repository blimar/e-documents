<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocController;
use App\Http\Controllers\MJabatanController;
use App\Http\Controllers\MKelompokController;
use App\Http\Controllers\MPangkatController;
use App\Http\Controllers\MPersonelController;
use App\Models\MKelompok;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return inertia('home');
// })->name('home');

Route::get('/', function () {
    return redirect('/admin');
});


Route::prefix('dashboard')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('pangkat', MPangkatController::class);
    Route::resource('jabatan', MJabatanController::class);
    Route::resource('kelompok', MKelompokController::class);
    Route::resource('kelompok.personel', MPersonelController::class);

    Route::get('/laporan-mutasi/{tanggal}/{status}/{kelompok}', [DocController::class, "laporanMutasi"])->name('laporan.mutasi');
    Route::get('/laporan-harian', [DocController::class, 'generate'])->name('laporan.harian');
    // Route::get('/laporan-harian/{tanggal}/{kelompok_id}/{personel_id}/{lp_no}', [DocController::class, 'generate'])->name('laporan.harian');
});
