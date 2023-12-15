<?php

namespace App\Http\Controllers;

use App\DataTables\PemerintahanPKKDataTable;
use App\Http\Requests\PemerintahanPKKRequest;
use App\Models\PemerintahanPKK;

class PemerintahanPKKController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PemerintahanPKKDataTable $dataTable)
    {
        return $dataTable->render('pemerintahan-pkk.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemerintahan-pkk.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PemerintahanPKKRequest $request)
    {
        $data=$request->all();
        PemerintahanPKK::create($data);
        return redirect()->route('pemerintahan-pkk.index')->with('success','data berhasil ditambahkan');
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
        return view('pemerintahan-pkk.edit',[
                    "data"=>$user,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PemerintahanPKKRequest $request, string $id)
    {
        $user=Penduduk::find($id)->update($request->all());
        return redirect()->route('pemerintahan-pkk.index')->with('success','data berhasil diubah'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=Penduduk::find($id)->delete();
        return redirect()->route('pemerintahan-pkk.index')->with('success','data berhasil dihapus'); 
    }
}
