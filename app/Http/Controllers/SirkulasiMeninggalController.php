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
        return view('sirkulasi-meninggal.index')->with('success','Data berhasil ditambahkan');
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
        return view('sirkulasi-meninggal.edit',[
            'data'=>$data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SirkulasiMeninggal $sirkulasiMeninggal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SirkulasiMeninggal $sirkulasiMeninggal)
    {
        //
    }
}
