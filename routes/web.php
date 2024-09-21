<?php

use App\Http\Controllers\ListDokterController;
use App\Http\Controllers\JadwalPasienController;
use App\Http\Controllers\DasboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::apiResource('/list/doctors', ListDokterController::class);
Route::apiResource('/jadwal/pasien', JadwalPasienController::class);