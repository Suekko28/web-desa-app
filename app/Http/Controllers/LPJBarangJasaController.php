<?php

namespace App\Http\Controllers;

use App\DataTables\LPJBarangJasaDataTable;
use App\Http\Requests\PemerintahanLPJRequest;
use App\Models\LPJBarangJasa;
use App\Models\LPJKegiatan;
use Illuminate\Http\Request;

class LPJBarangJasaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LPJBarangJasaDataTable $dataTable)
    {
    return $dataTable->render('lpj-barangjasa.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lpj-barangjasa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PemerintahanLPJRequest $request)
    {
        $data=$request->all();

        LPJBarangJasa::create($data);
        
        return redirect()->route('lpj-barangjasa.index')->with('success','data berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(LPJBarangJasa $lPJKegiatan)
    {
        $data=LPJBarangJasa::find($id);
     
        return view('lpj-barangjasa.view',[
            "data"=>$data,
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $data=LPJBarangJasa::find($id);
        return view('lpj-barangjasa.edit',[
                    "data"=>$data,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user=LPJBarangJasa::find($id)->update($request->all());
        return redirect()->route('lpj-barangjasa.index')->with('success','data berhasil diubah'); 

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $user=LPJBarangJasa::find($id)->delete();
        return redirect()->route('lpj-barangjasa.index')->with('success','data berhasil dihapus'); 

    }
}
