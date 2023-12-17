<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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

Auth::routes([
    'reset'=>false,
    'verify'=>false,
]);

Route::middleware(['auth'])->group(function(){
    Route::get('/',[\App\Http\Controllers\DashboardController::class,'index'])->name('index');

    
    Route::get('/index',[\App\Http\Controllers\DashboardController::class,'index'])->name('index');

    Route::Resource('/pemerintahan-desa',\App\Http\Controllers\PemerintahanDesaController::class);
    Route::Resource('/pemerintahan-BPD',\App\Http\Controllers\PemerintahanBPDController::class);
    Route::Resource('/pemerintahan-lpm',\App\Http\Controllers\PemerintahanLPMController::class);
    Route::Resource('/pemerintahan-mui',\App\Http\Controllers\PemerintahanMUIController::class);
    Route::Resource('/pemerintahan-pkk',\App\Http\Controllers\PemerintahanPKKController::class);
    Route::Resource('/pemerintahan-sahbandar',\App\Http\Controllers\PemerintahanSahbandarController::class);
    Route::Resource('/pemerintahan-karang-taruna',\App\Http\Controllers\PemerintahanKarangTarunaController::class);
    Route::Resource('/pemerintahan-posyandu',\App\Http\Controllers\PemerintahanPosyanduController::class);
    Route::Get('/penduduk-import',[\App\Http\Controllers\PendudukController::class,'importPendudukView'])->name('penduduk.import-view');
    Route::Post('/penduduk-import',[\App\Http\Controllers\PendudukController::class,'importPenduduk'])->name('penduduk.import');
    Route::Resource('/penduduk',\App\Http\Controllers\PendudukController::class);
});
