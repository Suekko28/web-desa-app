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
    'reset' => false,
    'verify' => false,
]);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('index');


    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('index');

    Route::get('/pemerintahan-desa/generate-pdf', [\App\Http\Controllers\PemerintahanDesaController::class, 'pdfTemplate'])
        ->name('pemerintahan-desa.generate-pdf');
    Route::Resource('/pemerintahan-desa', \App\Http\Controllers\PemerintahanDesaController::class);
    Route::Resource('/pemerintahan-BPD', \App\Http\Controllers\PemerintahanBPDController::class);
    Route::get('/pemerintahan-bpd/generate-pdf', [\App\Http\Controllers\PemerintahanBPDController::class, 'pdfTemplate'])
        ->name('pemerintahan-BPD.pdf-template');
    Route::get('/pemerintahan-lpm/generate-pdf', [\App\Http\Controllers\PemerintahanLPMController::class, 'pdfTemplate'])
        ->name('pemerintahan-lpm.generate-pdf');
    Route::Resource('/pemerintahan-lpm', \App\Http\Controllers\PemerintahanLPMController::class);
    Route::get('/pemerintahan-mui/generate-pdf', [\App\Http\Controllers\PemerintahanMUIController::class, 'pdfTemplate'])
        ->name('pemerintahan-mui.generate-pdf');
    Route::Resource('/pemerintahan-mui', \App\Http\Controllers\PemerintahanMUIController::class);
    Route::get('/pemerintahan-pkk/generate-pdf', [\App\Http\Controllers\PemerintahanPKKController::class, 'pdfTemplate'])
        ->name('pemerintahan-pkk.generate-pdf');
    Route::Resource('/pemerintahan-pkk', \App\Http\Controllers\PemerintahanPKKController::class);
    Route::get('/pemerintahan-sahbandar/generate-pdf', [\App\Http\Controllers\PemerintahanSahbandarController::class, 'pdfTemplate'])
    ->name('pemerintahan-sahbandar.generate-pdf');
    Route::Resource('/pemerintahan-sahbandar', \App\Http\Controllers\PemerintahanSahbandarController::class);
    Route::get('/pemerintahan-karang-taruna/generate-pdf', [\App\Http\Controllers\PemerintahanKarangTarunaController::class, 'pdfTemplate'])
    ->name('pemerintahan-karangtaruna.generate-pdf');
    Route::Resource('/pemerintahan-karang-taruna', \App\Http\Controllers\PemerintahanKarangTarunaController::class);
    Route::get('/pemerintahan-posyandu/generate-pdf', [\App\Http\Controllers\PemerintahanPosyanduController::class, 'pdfTemplate'])
    ->name('pemerintahan-posyandu.generate-pdf');
    Route::Resource('/pemerintahan-posyandu', \App\Http\Controllers\PemerintahanPosyanduController::class);
    Route::get('/pemerintahan-rt/generate-pdf', [\App\Http\Controllers\PemerintahanRTController::class, 'pdfTemplate'])
    ->name('pemerintahan-rt.generate-pdf');
    Route::Resource('/pemerintahan-rt', \App\Http\Controllers\PemerintahanRTController::class);
    Route::get('/pemerintahan-rw/generate-pdf', [\App\Http\Controllers\PemerintahanRWController::class, 'pdfTemplate'])
    ->name('pemerintahan-rw.generate-pdf');
    Route::Resource('/pemerintahan-rw', \App\Http\Controllers\PemerintahanRWController::class);
    Route::get('/pemerintahan-kadus/generate-pdf', [\App\Http\Controllers\PemerintahanKadusController::class, 'pdfTemplate'])
    ->name('pemerintahan-kadus.generate-pdf');
    Route::Resource('/pemerintahan-kadus', \App\Http\Controllers\PemerintahanKadusController::class);
    Route::Get('/penduduk-import', [\App\Http\Controllers\PendudukController::class, 'importPendudukView'])->name('penduduk.import-view');
    Route::Post('/penduduk-import', [\App\Http\Controllers\PendudukController::class, 'importPenduduk'])->name('penduduk.import');
    Route::Resource('/penduduk', \App\Http\Controllers\PendudukController::class);
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
    Route::get('/penduduk-generate-pdf', [\App\Http\Controllers\PendudukController::class, 'pdfTemplate'])
    ->name('penduduk.generate-pdf');
    Route::Resource('/penduduk',\App\Http\Controllers\PendudukController::class);
    Route::get('/sirkulasi-melahirkan/generate-pdf', [\App\Http\Controllers\SirkulasiMelahirkanController::class, 'pdfTemplate'])
    ->name('sirkulasi-melahirkan.generate-pdf');
    Route::Resource('/sirkulasi-melahirkan',\App\Http\Controllers\SirkulasiMelahirkanController::class);
    Route::get('/sirkulasi-meninggal/generate-pdf', [\App\Http\Controllers\SirkulasiMeninggalController::class, 'pdfTemplate'])
    ->name('sirkulasi-meninggal.generate-pdf');
    Route::Resource('/sirkulasi-meninggal',\App\Http\Controllers\SirkulasiMeninggalController::class);
    Route::get('/sirkulasi-pendatang/generate-pdf', [\App\Http\Controllers\SirkulasiPendatangController::class, 'pdfTemplate'])
    ->name('sirkulasi-pendatang.generate-pdf');
    Route::Resource('/sirkulasi-pendatang',\App\Http\Controllers\SirkulasiPendatangController::class);
    Route::get('/sirkulasi-pindah/generate-pdf', [\App\Http\Controllers\SirkulasiPindahController::class, 'pdfTemplate'])
    ->name('sirkulasi-pindah.generate-pdf');
    Route::Resource('/sirkulasi-pindah',\App\Http\Controllers\SirkulasiPindahController::class);
    Route::get('/lpj-barangjasa/generate-pdf', [\App\Http\Controllers\LPJBarangJasaController::class, 'pdfTemplate'])
    ->name('lpj-barangjasa.generate-pdf');
    Route::Resource('/lpj-barangjasa',\App\Http\Controllers\LPJBarangJasaController::class);
    Route::get('/lpj-belanja/generate-pdf/{id}', [\App\Http\Controllers\LPJBelanjaController::class, 'pdfTemplate'])
    ->name('lpj-belanja.generate-pdf');
    Route::Resource('/lpj-belanja',\App\Http\Controllers\LPJBelanjaController::class);
    Route::get('/lpj-belanja/{id}/create','\App\Http\Controllers\LPJBelanjaController@create')->name('lpj-belanja.create');
    Route::get('/lpj-belanja/{id_barang_jasa}/{id}/edit','\App\Http\Controllers\LPJBelanjaController@edit')->name('lpj-belanja.edit');
    Route::put('/lpj-belanja/{id_barang_jasa}/{id}', '\App\Http\Controllers\LPJBelanjaController@update')->name('lpj-belanja.update');
    Route::delete('/lpj-belanja/{id_barang_jasa}/{id}','\App\Http\Controllers\LPJBelanjaController@destroy')->name('lpj-belanja.destroy');
    Route::Resource('/lpj-timpemeriksa',\App\Http\Controllers\LPJTimPemeriksaController::class);
    Route::get('/lpj-timpemeriksa/generate-pdf', [\App\Http\Controllers\LPJTimPemeriksaController::class, 'pdfTemplate'])
    ->name('lpj-timpemeriksa.generate-pdf');
});


// Route::get('/lpj-timpemeriksa', function(){
//     return view('lpj-timpemeriksa.create');  
// });

