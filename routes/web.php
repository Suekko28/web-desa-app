<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/datapenduduk', function () {
    return view('admin.penduduk.index');
});

Route::get('/datapenduduk/create', function () {
    return view('admin.penduduk.create');
});

Route::get('/pemerintahandesa', function () {
    return view('admin.pemerintahan.desa.index');
});

Route::get('/pemerintahandesa/create', function () {
    return view('admin.pemerintahan.desa.create');
});

Route::get('/bpd', function () {
    return view('admin.pemerintahan.desa.index');
});

Route::get('/bpd/create', function () {
    return view('admin.pemerintahan.desa.create');
});

Route::get('/suratkependudukan', function () {
    return view('admin.surat.kependudukan.index');
});


Route::get('/suratkependudukan/create', function () {
    return view('admin.surat.kependudukan.create');
});

//my credential
//http://user:password@192.168.0.1:3128
// Route::get('/admin/dashboard', function () {
//     return view('dashboard');
// });

// Auth::routes();

Route::get('/dashboard',[App\Http\Controllers\DashboardController::class,'index'])->name('dashboard');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

