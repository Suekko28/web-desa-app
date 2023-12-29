<?php

namespace App\Http\Controllers;

use App\DataTables\SirkulasiMeninggalDatatable;
use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use App\Models\SirkulasiMeninggal;
use Illuminate\Http\Request;

class SirkulasiMeninggalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SirkulasiMeninggalDataTable $dataTable)
    {

        return $dataTable->render('sirkulasi-meninggal.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data=Penduduk::all();
        return view('sirkulasi-meninggal.create',[
            'data'=>$data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        SirkulasiMeninggal::create($request->all());
        return redirect()->route('sirkulasi-meninggal.index')->with('success','Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(SirkulasiMeninggal $sirkulasiMeninggal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $data=SirkulasiMeninggal::find($id);
        $nkk=$data->NIK_penduduk;
        $data['nama']=Penduduk::where('NIK','=',$nkk)->first()->nama;
        $data_penduduk=Penduduk::all();

        return view('sirkulasi-meninggal.edit',[
            'data'=>$data,
            'data_penduduk'=>$data_penduduk,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {  
        $data=SirkulasiMeninggal::find($id);
        
        $data->update($request->all());
        return redirect()->route('sirkulasi-meninggal.index')->with('success','data berhasil diupdate'); 

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=SirkulasiMeninggal::find($id)->delete();
        return redirect()->route('sirkulasi-meninggal.index')->with('success','data berhasil dihapus'); 

    }
}
