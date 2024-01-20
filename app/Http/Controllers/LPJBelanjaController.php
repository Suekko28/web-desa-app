<?php

namespace App\Http\Controllers;

use App\DataTables\LPJBelanjaDataTable;
use App\Models\LPJBelanja;
use App\Models\LPJTimPemeriksa;
use App\Models\LPJBarangJasa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


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

    public function pdfTemplate(LPJBelanjaDataTable $dataTable)
    {
        // Retrieve the data directly from the query builder
        $data = $dataTable->query(new LPJBelanja())->get();

        // Send data to the view for PDF rendering
        $html = view('lpj-belanja.generate-pdf', ['data' => $data])->render();

        // Adjust PDF options if needed
        $pdf = PDF::loadHtml($html)->setPaper('f4', 'portrait');

        return $pdf->stream('LPJBelanja.pdf');
    }
}
