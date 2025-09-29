<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ApiKeyMiddleware;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AbsensiController;
use App\Http\Controllers\Api\RequestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them
| will be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware([ApiKeyMiddleware::class])->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    Route::get('/absensi', [AbsensiController::class, 'index']);
    Route::post('/absensi/masuk', [AbsensiController::class, 'absenMasuk']);
    Route::post('/absensi/keluar', [AbsensiController::class, 'absenKeluar']);
    Route::get('/absensi/{id}', [AbsensiController::class, 'show']);

    Route::get('/request', [RequestController::class, 'index']);
    Route::post('/request', [RequestController::class, 'store']);
    Route::get('/request/{id}', [RequestController::class, 'show']);
    Route::put('/request/{id}', [RequestController::class, 'update']);
    Route::delete('/request/{id}', [RequestController::class, 'destroy']);
});

Route::options('{any}', function () {
    return response()->json(['status' => 'CORS OK'], 200);
})->where('any', '.*');
