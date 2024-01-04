<?php

namespace App\Http\Controllers;

use App\DataTables\LPJBelanjaDataTable;
use App\Models\LPJBelanja;
use Illuminate\Http\Request;

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
        return view('lpj-belanja.create',[
            'id'=>$id,
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

        return view('lpj-belanja.edit',[
            'data'=>$data,
            'id'=>$id,
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
}
