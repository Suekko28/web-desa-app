<?php

namespace App\Http\Controllers;

use App\DataTables\PendudukDataTable;
use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PendudukDataTable $dataTable)
    {
        //tes blade
        return $dataTable->render('penduduk.index');
        // return $dataTable->render('penduduk-desa.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penduduk.create');
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
    public function show(Penduduk $penduduk)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $user=Penduduk::find($id);
        return view('penduduk.edit',[
                    "data"=>$user,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PendudukFormRequest $request, string $id)
    {
        $user=PemerintahanSahbandar::find($id)->update($request->all());
        return redirect()->route('penduduk.index')->with('success','data berhasil diubah'); 
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=PemerintahanSahbandar::find($id)->delete();
        return redirect()->route('pemerintahan-sahbandar.index')->with('success','data berhasil dihapus'); 

    }
}
