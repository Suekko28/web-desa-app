<?php

namespace App\Http\Controllers;

use App\DataTables\LPJBarangJasaDataTable;
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
    public function store(Request $request)
    {
        $data=$request->all();

        Penduduk::create($data);
        
        return redirect()->route('penduduk.index')->with('success','data berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(LPJKegiatan $lPJKegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LPJKegiatan $lPJKegiatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LPJKegiatan $lPJKegiatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LPJKegiatan $lPJKegiatan)
    {
        //
    }
}
