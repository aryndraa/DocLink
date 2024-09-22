<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ScheduleController;

// Route untuk Doctor
Route::get('/doctors', [DoctorController::class, 'index']);
Route::get('/doctors/{doctor}', [DoctorController::class, 'show']);
Route::post('/doctors', [DoctorController::class, 'store']);
Route::put('/doctors/{doctor}', [DoctorController::class, 'update']);
Route::delete('/doctors/{doctor}', [DoctorController::class, 'destroy']);

// Route untuk Schedule
Route::get('/jadwal/pasien', [ScheduleController::class, 'index']);
Route::get('/jadwal/pasien/{schedule}', [ScheduleController::class, 'show']);
Route::post('/jadwal/pasien', [ScheduleController::class, 'store']);
Route::put('/jadwal/pasien/{schedule}', [ScheduleController::class, 'update']);
Route::delete('/jadwal/pasien/{schedule}', [ScheduleController::class, 'destroy']);
