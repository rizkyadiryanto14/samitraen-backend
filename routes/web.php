<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PetugasController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Models\LaporanKebakaran;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'loginView'])->middleware(GuestMiddleware::class)->name('login-view');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth', AdminMiddleware::class]], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    Route::get('/wilayah', [WilayahController::class, 'index'])->name('wilayah.index');

    Route::get('/unit', [UnitController::class, 'index'])->name('unit.index');

    Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


