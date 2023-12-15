<?php

namespace App\Http\Controllers;

use App\DataTables\PemerintahanPosyanduDataTable;
use App\Http\Requests\PemerintahanPosyanduRequest;
use App\Models\PemerintahanPosyandu;

class PemerintahanPosyanduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PemerintahanPosyanduDataTable $dataTable)
    {
        return $dataTable->render('pemerintahan-posyandu.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemerintahan-posyandu.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PemerintahanPosyanduRequest $request)
    {
        $data=$request->all();
        PemerintahanPosyandu::create($data);
        return redirect()->route('pemerintahan-posyandu.index')->with('success','data berhasil ditambahkan');
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
        return view('pemerintahan-posyandu.edit',[
                    "data"=>$user,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PemerintahanPosyanduRequest $request, string $id)
    {
        $user=Penduduk::find($id)->update($request->all());
        return redirect()->route('pemerintahan-posyandu.index')->with('success','data berhasil diubah'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=Penduduk::find($id)->delete();
        return redirect()->route('pemerintahan-posyandu.index')->with('success','data berhasil dihapus'); 
    }
}
