<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;


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

Route::Resource('/pemerintahan-desa',App\Http\Controllers\PemerintahanDesaController::class);

Route::get('/', function () {
    return view('index');
});

Route::get('/index', function () {
    return view('index');
})->name('dashboard');

// Route::get('/datapenduduk', function () {
//     return view('admin.penduduk.index');
// });

// Route::get('/form', function () {
//     return view('penduduk.create');
// });

Route::get('/datapenduduk/create', function () {
    return view('penduduk.create');
});

Route::get('/pemerintahandesa', function () {
    return view('admin.pemerintahan.desa.index');
});

Route::get('/pemerintahandesa/create', function () {
    return view('admin.pemerintahan.desa.create');
});

Route::get('/bpd', function () {
    return view('admin.pemerintahan.bpd.index');
});

Route::get('/bpd/create', function () {
    return view('admin.pemerintahan.bpd.create');
});

Route::get('/suratkependudukan', function () {
    return view('admin.surat.kependudukan.index');
});



// Route::get('/pemerintahandesa', function () {
//     return view('admin.pemerintahan.desa.index');
// });

// Route::get('/pemerintahandesa/create', function () {
//     return view('admin.pemerintahan.desa.create');
// });

// Route::get('/bpd', function () {
//     return view('admin.pemerintahan.desa.index');
// });

// Route::get('/bpd/create', function () {
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

Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

