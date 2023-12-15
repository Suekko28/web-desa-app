<?php

namespace App\Http\Controllers;

use App\DataTables\PemerintahanKarangTarunaDataTable;
use App\Http\Requests\PemerintahanKarangTarunaRequest;
use App\Models\PemerintahanKarangTaruna;

class PemerintahanKarangTarunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PemerintahanKarangTarunaDataTable $dataTable)
    {
        return $dataTable->render('pemerintahan-karangtaruna.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemerintahan-karangtaruna.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PemerintahanKarangTarunaRequest $request)
    {
        $data=$request->all();
        PemerintahanKarangTaruna::create($data);
        return redirect()->route('pemerintahan-karangtaruna.index')->with('success','data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $user=Penduduk::find($id);
        return view('pemerintahan-karangtaruna.edit',[
                    "data"=>$user,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PemerintahanKarangTarunaRequest $request, string $id)
    {
        $user=Penduduk::find($id)->update($request->all());
        return redirect()->route('pemerintahan-karangtaruna.index')->with('success','data berhasil diubah'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=Penduduk::find($id)->delete();
        return redirect()->route('pemerintahan-karangtaruna.index')->with('success','data berhasil dihapus'); 
    }
}
