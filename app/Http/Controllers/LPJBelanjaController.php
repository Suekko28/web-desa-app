<?php

namespace App\Http\Controllers;

use App\DataTables\LPJBelanjaDataTable;
use App\Models\LPJBarangJasa;
use App\Models\LPJTimPemeriksa;
use App\Models\LPJBelanja;
use App\Models\LPJKegiatan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Riskihajar\Terbilang\Facades\Terbilang;
use Carbon\Carbon;

class LPJBelanjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(String $id)
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(String $id,Request $request)
    {
        $data_pemeriksa=LPJTimPemeriksa::all();

        return view('lpj-belanja.create',[
            'id'=>$id,
            'data_pemeriksa'=>$data_pemeriksa,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['id_barang_jasa']=$request->id;
        LPJBelanja::create($request->all());
        return redirect()->route('lpj-belanja.show',['lpj_belanja'=>$request->id])->with('success','Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {

        $dataTable = new LPJBelanjaDataTable($id);
        return $dataTable->render('lpj-belanja.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id_barang_jasa,String $id)
    {
        $data=LPJBelanja::where('id','=',$id)->where('id_barang_jasa','=',$id_barang_jasa)->first();
        $data_pemeriksa=LPJTimPemeriksa::all();
        $data['nama_pemeriksa']=LPJTimPemeriksa::where('NIP','=',$data['tim_pemeriksa'])->first()->nama;

        return view('lpj-belanja.edit',[
            'data'=>$data,
            'id'=>$id,
            'data_pemeriksa'=>$data_pemeriksa,
            'id_barang_jasa'=>$id_barang_jasa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,String $id_barang_jasa,String $id)
    {
        $request['id']=$id;
        $request['id_barang_jasa']=$id_barang_jasa;
        LPJBelanja::find($id)->update($request->all());
        return redirect()->route('lpj-belanja.show',['lpj_belanja'=>$id_barang_jasa])->with('success','Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id_barang_jasa,String $id)
    {
        $user=LPJBelanja::find($id)->delete();
        return redirect()->route('lpj-belanja.show',['lpj_belanja'=>$id_barang_jasa])->with('success','Berhasil menghapus data');
    }

    public function pdfTemplate(LPJBelanjaDataTable $dataTable,String $id)
    {

        // Retrieve the data directly from the query builder
        $date=date('Y-m-d');
        $tanggal=Terbilang::date($date);
        $hari=Carbon::now()->isoFormat('dddd');
        $tahun=Carbon::now()->isoFormat('Y');

        $data = $dataTable->query(new LPJBelanja())->get();
        $data_belanja=LPJBarangJasa::find($id);

        $data_barang=$data_belanja->LPJBelanja()->get();
        // Send data to the view for PDF rendering
        if(sizeof($data_barang)==0){
            return redirect()->route('lpj-barangjasa.index')->with('error',"tidak ada data belanja untuk toko ini");
        }
        $date_pesanan=LPJBarangJasa::first()->tgl_pesanan;
        $date_pesanan=strtotime($date_pesanan);
        $tahun_terbilang=Terbilang::make(date('Y'));

        $bulan_pesanan_terbilang=Carbon::create()->month(date('m',$date_pesanan))->isoFormat('MMMM');
        $tahun_pesanan=Carbon::create()->year(date('Y',$date_pesanan))->isoFormat('Y');
        $date_pesanan=date('d',$date_pesanan).' '.$bulan_pesanan_terbilang.' '.$tahun_pesanan;

        $date_pemeriksa= LPJTimPemeriksa::first()->tgl_pemeriksa;
        $date_pemeriksa=strtotime($date_pemeriksa);
        $tahun_terbilang=Terbilang::make(date('Y'));

        $bulan_pesanan_terbilang=Carbon::create()->month(date('m',$date_pemeriksa))->isoFormat('MMMM');
        $tahun_pesanan=Carbon::create()->year(date('Y',$date_pemeriksa))->isoFormat('Y');
        $date_pemeriksa=date('d',$date_pemeriksa).' '.$bulan_pesanan_terbilang.' '.$tahun_pesanan;
        $total_dana=0;
        foreach($data_barang as $i){

            $total_dana+=$i->dana_desa;
        }
        $data_belanja['dana_desa']=$total_dana;

        $data_pemeriksa=LPJTimPemeriksa::where('NIP','=',$data_belanja->tim_pemeriksa)->get();
        $data_anggota_pemeriksa=$data_pemeriksa->first()->AnggotaLPJTimPemeriksa()->get();
        $html = view('lpj-belanja.generate-pdf', ['date_pemeriksa' => $date_pemeriksa,'tahun'=>$tahun_terbilang,'date_pesanan'=>$date_pesanan,'hari'=>$hari,'tanggal_hari_ini'=>$tanggal,'data_anggota_pemeriksa'=>$data_anggota_pemeriksa,'data_pemeriksa'=>$data_pemeriksa->first(),'data' => $data,'data_belanja'=>$data_belanja,'data_barang'=>$data_barang])->render();
        

        // Adjust PDF options if needed
        $pdf = PDF::loadHtml($html)->setPaper('f4', 'portrait');

        return $pdf->stream('LPJBelanja.pdf');
    }
}
