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

Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::get('/', function () {
        return view('index');
    });
    
    Route::get('/index', function () {
        return view('index');
    })->name('index');

    Route::Resource('/pemerintahan-desa',\App\Http\Controllers\PemerintahanDesaController::class);
    Route::Resource('/pemerintahan-BPD',\App\Http\Controllers\PemerintahanBPDController::class);
    Route::Resource('/pemerintahan-lpm',\App\Http\Controllers\PemerintahanLPMController::class);
    Route::Resource('/pemerintahan-mui',\App\Http\Controllers\PemerintahanMUIController::class);
    Route::Resource('/pemerintahan-pkk',\App\Http\Controllers\PemerintahanPKKController::class);
    Route::Resource('/pemerintahan-sahbandar',\App\Http\Controllers\PemerintahanSahbandarController::class);
    Route::Resource('/pemerintahan-karang-taruna',\App\Http\Controllers\PemerintahanKarangTarunaController::class);
    Route::Resource('/pemerintahan-posyandu',\App\Http\Controllers\PemerintahanPosyanduController::class);
    
    Route::Resource('/penduduk',PendudukController::class);
});


// Route::get('/datapenduduk', function () {
//     return view('admin.penduduk.index');
// });

// Route::get('/form', function () {
//     return view('penduduk.create');
// });



// Route::get('/datapenduduk', function () {
//     return view('penduduk.index');
// });

// Route::get('/datapenduduk/create', function () {
//     return view('penduduk.create');
// });

// Route::get('/pemerintahandesa', function () {
//     return view('pemerintahan-desa.index');
// });

// Route::get('/pemerintahandesa/create', function () {
//     return view('pemerintahan-desa.create');
// });

// Route::get('/BPD', function () {
//     return view('pemerintahan-BPD.index');
// });

// Route::get('/BPD/create', function () {
//     return view('pemerintahan-BPD.create');
// });

// Route::get('/lpm', function () {
//     return view('pemerintahan-lpm.index');
// });

// Route::get('/lpm/create', function () {
//     return view('pemerintahan-lpm.create');
// });

// Route::get('/suratkependudukan', function () {
//     return view('surat-kependudukan.index');
// });



// Route::get('/pemerintahandesa', function () {
//     return view('admin.pemerintahan.desa.index');
// });

// Route::get('/pemerintahandesa/create', function () {
//     return view('admin.pemerintahan.desa.create');
// });

// Route::get('/BPD', function () {
//     return view('admin.pemerintahan.desa.index');
// });

// Route::get('/BPD/create', function () {
//     return view('admin.pemerintahan.desa.create');
// });

// Route::get('/suratkependudukan', function () {
//     return view('admin.surat.kependudukan.index');
// });


// Route::get('/suratkependudukan/create', function () {
//     return view('admin.surat.kependudukan.create');
// });

//my credential
//http://user:password@192.168.0.1:3128
// Route::get('/admin/dashboard', function () {
//     return view('dashboard');
// });



// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

