<?php

namespace App\Http\Controllers;

use App\DataTables\SirkulasiMelahirkanDatatable;
use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use App\Models\Anak;
use App\Models\SirkulasiMelahirkan;
use Illuminate\Http\Request;

class SirkulasiMelahirkanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SirkulasiMelahirkanDatatable $dataTable)
    {
        return $dataTable->render('sirkulasi-melahirkan.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data=Penduduk::all()->unique('NKK');
        return view('sirkulasi-melahirkan.create',[
            "data"=>$data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        
        Anak::create($request->all());
        return redirect()->route('sirkulasi-melahirkan.index')->with('success','Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(SirkulasiMelahirkan $sirkulasiMelahirkan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $data=Anak::find($id);
        return view('sirkulasi-melahirkan.edit',[
            "data"=>$data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SirkulasiMelahirkan $sirkulasiMelahirkan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SirkulasiMelahirkan $sirkulasiMelahirkan)
    {
        //
    }
}
