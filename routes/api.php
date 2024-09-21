<?php

use App\Http\Controllers\ListDokterController;
use App\Http\Controllers\JadwalPasienController;
use Illuminate\Support\Facades\Route;


Route::apiResource('/list/doctors', ListDokterController::class);
Route::apiResource('/jadwal/pasien', JadwalPasienController::class);