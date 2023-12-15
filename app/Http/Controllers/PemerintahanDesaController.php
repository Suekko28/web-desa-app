<?php

namespace App\Http\Controllers;

use App\DataTables\PemerintahDesaDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\PemerintahanDesaFormRequest;
use App\Http\Requests\PendudukFormRequest;
use App\Models\PemerintahanDesa;
use Illuminate\Http\Request;

class PemerintahanDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PemerintahDesaDataTable $dataTable)
    {
        // dd($dataTable);
        return $dataTable->render('pemerintahan-desa.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemerintahan-desa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PemerintahanDesaFormRequest $request)
    {
        $data=$request->all();
        PemerintahanDesa::create($data);
        return redirect()->route('pemerintahan-desa.index')->with('success','data berhasil ditambahkan'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=Penduduk::find($id);
        return view('pemerintahan-desa.edit',[
                    "data"=>$user,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PendudukFormRequest $request, string $id)
    {
        $user=Penduduk::find($id)->update($request->all());
        return redirect()->route('pemerintahan-desa.index')->with('success','data berhasil diubah'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=Penduduk::find($id)->delete();
        return redirect()->route('pemerintahan-desa.index')->with('success','data berhasil dihapus'); 

    }
}
