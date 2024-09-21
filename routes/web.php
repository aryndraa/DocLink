<?php

use App\Http\Controllers\ListDokterController;
use App\Http\Controllers\JadwalPasienController;
use App\Http\Controllers\DasboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin') 
    ->group(function() {
        Route::controller(DasboardController::class)
            ->prefix('dashboard')
            ->name('dasboard')
            ->group(function() {
                Route::get('/', 'index')->name('index');
            });
    });

Route::apiResource('/list/doctors', ListDokterController::class);
Route::apiResource('/jadwal/pasien', JadwalPasienController::class);