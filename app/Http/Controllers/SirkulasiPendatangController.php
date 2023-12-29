<?php

namespace App\Http\Controllers;

use App\DataTables\SirkulasiPendatangDataTable;
use App\Models\SirkulasiPendatang;
use Illuminate\Http\Request;

class SirkulasiPendatangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SirkulasiPendatangDataTable $dataTable)
    {
        return $dataTable->render('sirkulasi-pendatang.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sirkulasi-pendatang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->all();
        SirkulasiPendatang::create($data);
        return redirect()->route('sirkulasi-pendatang.index')->with('success','data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(SirkulasiPendatang $dataPendatang)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $data=SirkulasiPendatang::find($id);
        return view('sirkulasi-pendatang.edit',[
            'data'=>$data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $data=SirkulasiPendatang::find($id);
        $data->update($request->all());
        return redirect()->route('sirkulasi-pendatang.index')->with('success','data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $user=SirkulasiPendatang::find($id)->delete();
        return redirect()->route('sirkulasi-pendatang.index')->with('success','data berhasil dihapus');

    }
}
