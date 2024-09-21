<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListDokterController;
use App\Http\Controllers\JadwalPasienController;

Route::apiResource('/list/doctors', ListDokterController::class);
Route::apiResource('/jadwal/pasien', JadwalPasienController::class);