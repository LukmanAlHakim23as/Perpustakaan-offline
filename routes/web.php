<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/',[AuthController::class, 'index']);
Route::post('/login',[AuthController::class, 'authenticate']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard',[DashboardController::class, 'index']);
    Route::get('/logout',[AuthController::class, 'logout']);
});

Route::middleware(['auth', 'role:pustakawan,admin'])->group(function () {
    Route::resource('/datapeminjaman',PeminjamanController::class);
    Route::get('/datalaporan',[PeminjamanController::class,'history'])->name('history');
    Route::get('/generatePdf',[PeminjamanController::class, 'generatePdf']);

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::resource('/datakategori',KategoriController::class);
        Route::resource('/datauser', UserController::class);
        Route::resource('/databuku', BukuController::class);
    });
});





