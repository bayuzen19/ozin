<?php

use App\Http\Controllers\AplikasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ChartController;
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

// Ini yang tanggung jawab ke Dashboard, 
Route::resource('/', DashboardController::class);
Route::resource('/indikator', IndikatorController::class);
Route::resource('/penilaian', PenilaianController::class);
Route::resource('/chart', ChartController::class);
Route::resource('/aplikasi', AplikasiController::class);
Route::resource('/users', UsersController::class);
Route::resource('/laporan', LaporanController::class);

Route::get('/login', [AuthController::class, 'login'])->middleware('isAuth');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::post('/penilaian/store', [PenilaianController::class, 'store'])->name('penilaian.store');
Route::get('/hitung-kematangan/{id}', [PenilaianController::class, 'hitungKematangan']);
Route::get('/chart/{id}', [ChartController::class, 'showChart'])->name('chart.show');
Route::get('/laporan/view/pdf/{id}', [LaporanController::class, 'viewPDF']);
