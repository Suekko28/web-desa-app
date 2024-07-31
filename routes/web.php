<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\PendudukApiController;
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

// Authentication Routes
Auth::routes([
    'reset' => false,
    'verify' => false,
]);

 // Penduduk API Routes
 Route::get('/penduduk', [PendudukApiController::class, 'index']);
 Route::post('/penduduk', [PendudukApiController::class, 'store']);
 Route::get('/penduduk/{id}', [PendudukApiController::class, 'show']);
 Route::put('/penduduk/{id}', [PendudukApiController::class, 'update']);
 Route::delete('/penduduk/{id}', [PendudukApiController::class, 'destroy']);


Route::middleware(['auth'])->group(function () {

   
    // Dashboard Routes
    // Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('index');
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('index');

    // Pemerintahan Desa Routes
    Route::get('/pemerintahan-desa/generate-pdf', [\App\Http\Controllers\PemerintahanDesaController::class, 'pdfTemplate'])
        ->name('pemerintahan-desa.generate-pdf');
    Route::resource('/pemerintahan-desa', \App\Http\Controllers\PemerintahanDesaController::class);

    // Pemerintahan BPD Routes
    Route::get('/pemerintahan-bpd/generate-pdf', [\App\Http\Controllers\PemerintahanBPDController::class, 'pdfTemplate'])
        ->name('pemerintahan-BPD.pdf-template');
    Route::resource('/pemerintahan-BPD', \App\Http\Controllers\PemerintahanBPDController::class);

    // Pemerintahan LPM Routes
    Route::get('/pemerintahan-lpm/generate-pdf', [\App\Http\Controllers\PemerintahanLPMController::class, 'pdfTemplate'])
        ->name('pemerintahan-lpm.generate-pdf');
    Route::resource('/pemerintahan-lpm', \App\Http\Controllers\PemerintahanLPMController::class);

    // Pemerintahan MUI Routes
    Route::get('/pemerintahan-mui/generate-pdf', [\App\Http\Controllers\PemerintahanMUIController::class, 'pdfTemplate'])
        ->name('pemerintahan-mui.generate-pdf');
    Route::resource('/pemerintahan-mui', \App\Http\Controllers\PemerintahanMUIController::class);

    // Pemerintahan PKK Routes
    Route::get('/pemerintahan-pkk/generate-pdf', [\App\Http\Controllers\PemerintahanPKKController::class, 'pdfTemplate'])
        ->name('pemerintahan-pkk.generate-pdf');
    Route::resource('/pemerintahan-pkk', \App\Http\Controllers\PemerintahanPKKController::class);

    // Pemerintahan Sahbandar Routes
    Route::get('/pemerintahan-sahbandar/generate-pdf', [\App\Http\Controllers\PemerintahanSahbandarController::class, 'pdfTemplate'])
        ->name('pemerintahan-sahbandar.generate-pdf');
    Route::resource('/pemerintahan-sahbandar', \App\Http\Controllers\PemerintahanSahbandarController::class);

    // Pemerintahan Karang Taruna Routes
    Route::get('/pemerintahan-karang-taruna/generate-pdf', [\App\Http\Controllers\PemerintahanKarangTarunaController::class, 'pdfTemplate'])
        ->name('pemerintahan-karangtaruna.generate-pdf');
    Route::resource('/pemerintahan-karang-taruna', \App\Http\Controllers\PemerintahanKarangTarunaController::class);

    // Pemerintahan Posyandu Routes
    Route::get('/pemerintahan-posyandu/generate-pdf', [\App\Http\Controllers\PemerintahanPosyanduController::class, 'pdfTemplate'])
        ->name('pemerintahan-posyandu.generate-pdf');
    Route::resource('/pemerintahan-posyandu', \App\Http\Controllers\PemerintahanPosyanduController::class);

    // Pemerintahan RT Routes
    Route::get('/pemerintahan-rt/generate-pdf', [\App\Http\Controllers\PemerintahanRTController::class, 'pdfTemplate'])
        ->name('pemerintahan-rt.generate-pdf');
    Route::resource('/pemerintahan-rt', \App\Http\Controllers\PemerintahanRTController::class);

    // Pemerintahan RW Routes
    Route::get('/pemerintahan-rw/generate-pdf', [\App\Http\Controllers\PemerintahanRWController::class, 'pdfTemplate'])
        ->name('pemerintahan-rw.generate-pdf');
    Route::resource('/pemerintahan-rw', \App\Http\Controllers\PemerintahanRWController::class);

    // Pemerintahan Kadus Routes
    Route::get('/pemerintahan-kadus/generate-pdf', [\App\Http\Controllers\PemerintahanKadusController::class, 'pdfTemplate'])
        ->name('pemerintahan-kadus.generate-pdf');
    Route::resource('/pemerintahan-kadus', \App\Http\Controllers\PemerintahanKadusController::class);

    // Penduduk Routes
    Route::get('/penduduk-import', [\App\Http\Controllers\PendudukController::class, 'importPendudukView'])->name('penduduk.import-view');
    Route::post('/penduduk-import', [\App\Http\Controllers\PendudukController::class, 'importPenduduk'])->name('penduduk.import');
    Route::get('/penduduk-generate-pdf', [\App\Http\Controllers\PendudukController::class, 'pdfTemplate'])
        ->name('penduduk.generate-pdf');
    Route::resource('/penduduk', \App\Http\Controllers\PendudukController::class);

    // Sirkulasi Melahirkan Routes
    Route::get('/sirkulasi-melahirkan/generate-pdf', [\App\Http\Controllers\SirkulasiMelahirkanController::class, 'pdfTemplate'])
        ->name('sirkulasi-melahirkan.generate-pdf');
    Route::resource('/sirkulasi-melahirkan', \App\Http\Controllers\SirkulasiMelahirkanController::class);

    // Sirkulasi Meninggal Routes
    Route::get('/sirkulasi-meninggal/generate-pdf', [\App\Http\Controllers\SirkulasiMeninggalController::class, 'pdfTemplate'])
        ->name('sirkulasi-meninggal.generate-pdf');
    Route::resource('/sirkulasi-meninggal', \App\Http\Controllers\SirkulasiMeninggalController::class);

    // Sirkulasi Pendatang Routes
    Route::get('/sirkulasi-pendatang/generate-pdf', [\App\Http\Controllers\SirkulasiPendatangController::class, 'pdfTemplate'])
        ->name('sirkulasi-pendatang.generate-pdf');
    Route::resource('/sirkulasi-pendatang', \App\Http\Controllers\SirkulasiPendatangController::class);

    // Sirkulasi Pindah Routes
    Route::get('/sirkulasi-pindah/generate-pdf', [\App\Http\Controllers\SirkulasiPindahController::class, 'pdfTemplate'])
        ->name('sirkulasi-pindah.generate-pdf');
    Route::resource('/sirkulasi-pindah', \App\Http\Controllers\SirkulasiPindahController::class);

    // LPJ Barang Jasa Routes
    Route::get('/lpj-barangjasa/generate-pdf', [\App\Http\Controllers\LPJBarangJasaController::class, 'pdfTemplate'])
        ->name('lpj-barangjasa.generate-pdf');
    Route::resource('/lpj-barangjasa', \App\Http\Controllers\LPJBarangJasaController::class);

    // LPJ Belanja Routes
    Route::get('/lpj-belanja/generate-pdf/{id}', [\App\Http\Controllers\LPJBelanjaController::class, 'pdfTemplate'])
        ->name('lpj-belanja.generate-pdf');
    Route::resource('/lpj-belanja', \App\Http\Controllers\LPJBelanjaController::class);
    // Route::get('/lpj-belanja/{id_barang_jasa}/{id}/edit', [\App\Http\Controllers\LPJBelanjaController::class, 'edit'])->name('lpj-belanja.edit');
    // Route::put('/lpj-belanja/{id_barang_jasa}/{id}', [\App\Http\Controllers\LPJBelanjaController::class, 'update'])->name('lpj-belanja.update');
    // Route::delete('/lpj-belanja/{id_barang_jasa}/{id}', [\App\Http\Controllers\LPJBelanjaController::class, 'destroy'])->name('lpj-belanja.destroy');

    // LPJ Tim Pemeriksa Routes
    Route::resource('/lpj-timpemeriksa', \App\Http\Controllers\LPJTimPemeriksaController::class);
    Route::get('/lpj-timpemeriksa/generate-pdf', [\App\Http\Controllers\LPJTimPemeriksaController::class, 'pdfTemplate'])
        ->name('lpj-timpemeriksa.generate-pdf');
});
