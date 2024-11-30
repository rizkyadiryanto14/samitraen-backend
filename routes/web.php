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

//TODO change route type to resource
Route::group(['middleware' => ['auth', AdminMiddleware::class]], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::resource('/wilayah', WilayahController::class);
    Route::resource('/unit', UnitController::class);
    Route::resource('/petugas', PetugasController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/laporan', LaporanController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


