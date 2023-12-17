<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $requests){
        $jumlah_laki_laki=Penduduk::where('jenis_kelamin','1');
        $jumlah_perempuan=Penduduk::where('jenis_kelamin','2');

        $penduduk = DB::table('penduduk')->get();
        
        $jumlah_penduduk=Penduduk::count();
        return view('index',compact('penduduk', 'jumlah_laki_laki', 'jumlah_perempuan'));

       
    }
}
