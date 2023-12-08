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

Route::get('/form', function () {
    return view('admin.penduduk.create');
});

Route::get('/datapenduduk/create', function () {
    return view('admin.penduduk.create');
});

//my credential
//http://user:password@192.168.0.1:3128
// Route::get('/admin/dashboard', function () {
//     return view('dashboard');
// });

// Auth::routes();

Route::get('/dashboard',[App\Http\Controllers\DashboardController::class,'index'])->name('dashboard');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

