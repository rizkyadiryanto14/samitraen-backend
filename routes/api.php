<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LaporanController;
use App\Http\Controllers\Api\PetugasController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\CheckUserRole;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('petugas')->middleware(CheckUserRole::class . ':petugas')->group(function () {
        Route::get('profil', [PetugasController::class, 'getProfile']);
        Route::put('profil', [PetugasController::class, 'updateProfile']);

        Route::prefix('pelaporan', function () {
            Route::get('/', [LaporanController::class, 'index']);
            Route::get('/{id_laporan}', [LaporanController::class, 'show']);
            Route::patch('/{id_laporan}/status', [LaporanController::class, 'updateStatus']);
            Route::get('/riwayat', [LaporanController::class, 'getRiwayat']); //filter by wilayah
        });
    });

    Route::prefix('pelapor')->middleware(CheckUserRole::class . ':user')->group(function () {
        Route::get('profil', [UserController::class, 'getProfile']);
        Route::put('profil', [UserController::class, 'updateProfile']);

        Route::prefix('pelaporan', function () {
            Route::post('/', [LaporanController::class, 'store']);
            Route::get('/{id_laporan}', [LaporanController::class, 'show']);
            Route::get('/riwayat', [LaporanController::class, 'getRiwayatByPelapor']);
        });
    });
});
