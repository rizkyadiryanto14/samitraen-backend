<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LaporanController;
use App\Http\Controllers\Api\PetugasController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WilayahController;
use App\Http\Middleware\CheckUserRole;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('petugas')->middleware(CheckUserRole::class . ':petugas')->group(function () {
        Route::get('profil', [PetugasController::class, 'getProfile']);
        Route::put('profil', [PetugasController::class, 'updateProfile']);

        Route::prefix('pelaporan')->group(function () {
            Route::get('/', [LaporanController::class, 'index']);
            Route::get('/terbaru', [LaporanController::class, 'getLaporanTerbaru']); //filter by wilayah
            Route::get('/riwayat', [LaporanController::class, 'getRiwayat']); //filter by wilayah
            Route::get('/{id_laporan}', [LaporanController::class, 'show']);
            Route::patch('/{id_laporan}/status', [LaporanController::class, 'update']);
        });

        Route::prefix('wilayah')->group(function () {
            Route::get('/', [WilayahController::class, 'index']);
        });

        Route::prefix('unit')->group(function () {
            Route::get('/', [UnitController::class, 'index']);
        });
    });

    Route::prefix('pelapor')->middleware(CheckUserRole::class . ':user')->group(function () {
        Route::get('profil', [UserController::class, 'getProfile']);
        Route::put('profil', [UserController::class, 'updateProfile']);

        Route::prefix('pelaporan')->group(function () {
            Route::post('/', [LaporanController::class, 'store']);
            Route::get('/riwayat', [LaporanController::class, 'getRiwayatByPelapor']);
            Route::get('/{id_laporan}', [LaporanController::class, 'showLaporanUser']);
        });
    });
});
