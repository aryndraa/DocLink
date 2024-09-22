<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ScheduleController;

Route::prefix('/') 
    ->group(function() {

      Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::controller(DoctorController::class)
            ->prefix('doctor')
            ->name('doctor.')
            ->group(function() {
                Route::get('/', 'index')->name('index');
                Route::get('/show/{doctor}', 'show')->name('show');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{doctor}', 'edit')->name('edit');
                Route::put('/update/{doctor}', 'update')->name('update');
                Route::delete('/destroy/{doctor}', 'destroy')->name('destroy');
            });

        Route::controller(PatientController::class)
            ->prefix('patient')
            ->name('patient.')
            ->group(function() {
                Route::get('/', 'index')->name('index');
                Route::get('/{patient}', 'show')->name('show');
                Route::post('/store', 'store')->name('store');
            });

        Route::controller(ScheduleController::class)
            ->prefix('schedule')
            ->name('schedule.')
            ->group(function() {
                Route::get('/', 'index')->name('index');
                Route::get('/show/{schedule}', 'show')->name('show');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{schedule}', 'edit')->name('edit');
                Route::put('/update/{schedule}', 'update')->name('update');
                Route::delete('/destroy/{schedule}', 'destroy')->name('destroy');
            });
    });
