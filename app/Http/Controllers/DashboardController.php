<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $requests){
        $jumlah_laki_laki=Penduduk::where('jenis_kelamin','1')->count();
        $jumlah_perempuan=Penduduk::where('jenis_kelamin','2')->count();
        
        $jumlah_penduduk=Penduduk::count();
        return view('index',[
            'jumlah_total'=>$jumlah_penduduk,
        ]);
    }
}
