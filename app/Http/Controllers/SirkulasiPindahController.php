<?php

namespace App\Http\Controllers;

use App\DataTables\SirkulasiPindahDataTable;
use App\Models\SirkulasiPindah;
use Illuminate\Http\Request;
use App\Models\Penduduk;

class SirkulasiPindahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SirkulasiPindahDataTable $dataTable)
    {
        return $dataTable->render('sirkulasi-pindah.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data_penduduk=Penduduk::all();
        return view('sirkulasi-pindah.create',[
            'data_penduduk'=>$data_penduduk,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user=SirkulasiPindah::create($request->all());
        return redirect()->route('sirkulasi-pindah.index')->with('success','Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(SirkulasiPindah $sirkulasiPindah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SirkulasiPindah $sirkulasiPindah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SirkulasiPindah $sirkulasiPindah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SirkulasiPindah $sirkulasiPindah)
    {
        //
    }
}
