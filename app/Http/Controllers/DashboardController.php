<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use App\Models\Penduduk;
use App\Models\SirkulasiPendatang;
use App\Models\SirkulasiPindah;
use App\Models\SirkulasiMeninggal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $requests)
    {
        $jumlah_laki_laki = Penduduk::where('jenis_kelamin', '1');
        $jumlah_perempuan = Penduduk::where('jenis_kelamin', '2');

        $jumlah_kepemilikan_e_ktp_ada = Penduduk::where('kepemilikan_e_ktp', '1');
        $jumlah_kepemilikan_e_ktp_tidak_ada = Penduduk::where('kepemilikan_e_ktp', '2');

        $sts_nikah_belum_kawin = Penduduk::where('status_pernikahan', '1');
        $sts_nikah_kawin = Penduduk::where('status_pernikahan', '2');
        $sts_nikah_cerai_hidup = Penduduk::where('status_pernikahan', '3');
        $sts_nikah_cerai_mati = Penduduk::where('status_pernikahan', '4');

        $agama_islam = Penduduk::where('agama', '1');
        $agama_kristen_protestan = Penduduk::where('agama', '2');
        $agama_kristen_katolik = Penduduk::where('agama', '3');
        $agama_hindu = Penduduk::where('agama', '4');
        $agama_buddha = Penduduk::where('agama', '5');
        $agama_khonghucu = Penduduk::where('agama', '6');

        $pendidikan_belum_sekolah = Penduduk::where('pendidikan', '1');
        $pendidikan_sd = Penduduk::where('pendidikan', '2');
        $pendidikan_sltp = Penduduk::where('pendidikan', '3');
        $pendidikan_slta = Penduduk::where('pendidikan', '4');
        $pendidikan_diploma_i = Penduduk::where('pendidikan', '5');
        $pendidikan_diploma_ii = Penduduk::where('pendidikan', '6');
        $pendidikan_diploma_iii = Penduduk::where('pendidikan', '7');
        $pendidikan_diploma_iv = Penduduk::where('pendidikan', '8');
        $pendidikan_sastra_i = Penduduk::where('pendidikan', '9');
        $pendidikan_sastra_ii = Penduduk::where('pendidikan', '10');
        $pendidikan_sastra_iii = Penduduk::where('pendidikan', '11');

        $bpjs_ppu = Penduduk::where('kepemilikan_bpjs', '1');
        $bpjs_pbpu = Penduduk::where('kepemilikan_bpjs', '2');
        $bpjs_pd_pemda = Penduduk::where('kepemilikan_bpjs', '3');
        $bpjs_bukan_pekerja = Penduduk::where('kepemilikan_bpjs', '4');
        $bpjs_pbi_jk = Penduduk::where('kepemilikan_bpjs', '5');
        $bpjs_tidak_ada = Penduduk::where('kepemilikan_bpjs', '6');

        $wni = Penduduk::where('kewarganegaraan', '1');
        $wna = Penduduk::where('kewarganegaraan', '2');
        $wni_wna = Penduduk::where('kewarganegaraan', '3');

        $pekerjaan = DB::table('penduduk')->get();

        $usia = DB::table('penduduk')->get();

        $penduduk = Penduduk::doesntHave('sirkulasimeninggal')->doesntHave('sirkulasipindah');

        $penduduk_all = Penduduk::get();

        $pekerjaan_swasta = Penduduk::where('pekerjaan', '1');
        $pekerjaan_pengrajin = Penduduk::where('pekerjaan', '2');
        $pekerjaan_wirausaha = Penduduk::where('pekerjaan', '3');
        $pekerjaan_guru = Penduduk::where('pekerjaan', '4');
        $pekerjaan_petani = Penduduk::where('pekerjaan', '5');
        
        $kelahiran = Anak::count();
        $meninggal = SirkulasiMeninggal::count();

        $pindah_masuk = SirkulasiPendatang::count();
        $pindah_keluar = SirkulasiPindah::count();
       
        return view('index', compact(
            'penduduk',
            'penduduk_all',
            'jumlah_laki_laki',
            'jumlah_perempuan',
            'jumlah_kepemilikan_e_ktp_ada',
            'jumlah_kepemilikan_e_ktp_tidak_ada',
            'sts_nikah_belum_kawin',
            'sts_nikah_kawin',
            'sts_nikah_cerai_hidup',
            'sts_nikah_cerai_mati',
            'agama_islam',
            'agama_kristen_protestan',
            'agama_kristen_katolik',
            'agama_hindu',
            'agama_buddha',
            'agama_khonghucu',
            'pendidikan_belum_sekolah',
            'pendidikan_sd',
            'pendidikan_sltp',
            'pendidikan_slta',
            'pendidikan_diploma_i',
            'pendidikan_diploma_ii',
            'pendidikan_diploma_iii',
            'pendidikan_diploma_iv',
            'pendidikan_sastra_i',
            'pendidikan_sastra_ii',
            'pendidikan_sastra_iii',
            'bpjs_ppu',
            'bpjs_pbpu',
            'bpjs_pd_pemda',
            'bpjs_bukan_pekerja',
            'bpjs_pbi_jk',
            'bpjs_tidak_ada',
            'wni',
            'wna',
            'wni_wna',
            'pekerjaan',
            'usia',
            'pekerjaan_swasta',
            'pekerjaan_pengrajin',
            'pekerjaan_wirausaha',
            'pekerjaan_guru',
            'pekerjaan_petani',
            'kelahiran',
            'meninggal',
            'pindah_masuk',
            'pindah_keluar',



        ));
    }

}
