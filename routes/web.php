<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MJabatanController;
use App\Http\Controllers\MKelompokController;
use App\Http\Controllers\MPangkatController;
use App\Http\Controllers\MPersonelController;
use App\Models\MKelompok;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return inertia('home');
})->name('home');



Route::prefix('dashboard')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('pangkat', MPangkatController::class);
    Route::resource('jabatan', MJabatanController::class);
    Route::resource('kelompok', MKelompokController::class);
    Route::resource('personel', MPersonelController::class);
});