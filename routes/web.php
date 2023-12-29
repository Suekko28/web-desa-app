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
    Route::get('/pemerintahan-bpd/generate-pdf', [\App\Http\Controllers\PemerintahanBPDController::class, 'pdfTemplate'])
    ->name('pemerintahan-BPD.pdf-template');
    Route::Resource('/pemerintahan-lpm',\App\Http\Controllers\PemerintahanLPMController::class);
    Route::Resource('/pemerintahan-mui',\App\Http\Controllers\PemerintahanMUIController::class);
    Route::Resource('/pemerintahan-pkk',\App\Http\Controllers\PemerintahanPKKController::class);
    Route::Resource('/pemerintahan-sahbandar',\App\Http\Controllers\PemerintahanSahbandarController::class);
    Route::Resource('/pemerintahan-karang-taruna',\App\Http\Controllers\PemerintahanKarangTarunaController::class);
    Route::Resource('/pemerintahan-posyandu',\App\Http\Controllers\PemerintahanPosyanduController::class);
    Route::Resource('/pemerintahan-rt',\App\Http\Controllers\PemerintahanRTController::class);
    Route::Resource('/pemerintahan-rw',\App\Http\Controllers\PemerintahanRWController::class);
    Route::Resource('/pemerintahan-kadus',\App\Http\Controllers\PemerintahanKadusController::class);
    Route::Get('/penduduk-import',[\App\Http\Controllers\PendudukController::class,'importPendudukView'])->name('penduduk.import-view');
    Route::Post('/penduduk-import',[\App\Http\Controllers\PendudukController::class,'importPenduduk'])->name('penduduk.import');
    Route::Resource('/penduduk',\App\Http\Controllers\PendudukController::class);
    Route::Resource('/sirkulasi-melahirkan',\App\Http\Controllers\SirkulasiMelahirkanController::class);
    Route::Resource('/lpj-barangjasa',\App\Http\Controllers\LPJBarangJasaController::class);
    Route::Resource('/sirkulasi-meninggal',\App\Http\Controllers\SirkulasiMeninggalController::class);

});



// Rapihin Field UI

//Sirkulasi Desa

// Route::get('/sirkulasi-melahirkan', function(){
//     return view('sirkulasi-melahirkan.index');
// });

// Route::get('/sirkulasi-melahirkan/create', function(){
//     return view('sirkulasi-melahirkan.create');
// });

// Route::get('/sirkulasi-melahirkan/edit', function(){
//     return view('sirkulasi-melahirkan.edit');
// });

// Route::get('/sirkulasi-meninggal', function(){
//     return view('sirkulasi-meninggal.index');
// });

// Route::get('/sirkulasi-meninggal/create', function(){
//     return view('sirkulasi-meninggal.create');
// });

// Route::get('/sirkulasi-meninggal/edit', function(){
//     return view('sirkulasi-meninggal.edit');
// });

// Route::get('/sirkulasi-pendatang', function(){
//     return view('sirkulasi-pendatang.index');
// });

// Route::get('/sirkulasi-pendatang/create', function(){
//     return view('sirkulasi-pendatang.create');
// });

// Route::get('/sirkulasi-pendatang/edit', function(){
//     return view('sirkulasi-pendatang.edit');
// });


// Route::get('/sirkulasi-pindah', function(){
//     return view('sirkulasi-pindah.index');
// });

// Route::get('/sirkulasi-pindah/create', function(){
//     return view('sirkulasi-pindah.create');
// });

// Route::get('/sirkulasi-pindah/edit', function(){
//     return view('sirkulasi-pindah.edit');
// });

// // LPJ Desa

// Route::get('/lpj-barang-jasa', function(){
//     return view('lpj-barangjasa.index');
// });

// Route::get('/lpj-barang-jasa/create', function(){
//     return view('lpj-barangjasa.create');
// });

// Route::get('/lpj-barang-jasa/edit', function(){
//     return view('lpj-barangjasa.edit');
// });

// Route::get('/lpj-barang-jasa/belanja', function(){
//     return view('lpj-belanja.index');
// });

// Route::get('/lpj-barang-jasa/belanja/create', function(){
//     return view('lpj-belanja.create');
// });

// Route::get('/lpj-barang-jasa/belanja/edit', function(){
//     return view('lpj-belanja.edit');
// });