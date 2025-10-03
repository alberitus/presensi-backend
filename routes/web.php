<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::resource('master/users', UserController::class);
    
    Route::put('/request/{id}/approve', [RequestController::class, 'approve'])->name('request.approve');
    Route::resource('request', RequestController::class);

    Route::get('/attendance/filter', [AbsensiController::class, 'filter'])->name('attendance.filter');
    Route::resource('attendance', AbsensiController::class);
});
