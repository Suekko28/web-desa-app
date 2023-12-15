<?php

namespace App\Http\Controllers;

use App\DataTables\PemerintahanSahbandarDataTable;
use App\Http\Requests\PemerintahanSahbandarRequest;
use App\Models\PemerintahanSahbandar;

class PemerintahanSahbandarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PemerintahanSahbandarDataTable $dataTable)
    {
        return $dataTable->render('pemerintahan-sahbandar.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemerintahan-sahbandar.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PemerintahanSahbandarRequest $request)
    {
        $data=$request->all();
        PemerintahanSahbandar::create($data);
        return redirect()->route('pemerintahan-sahbandar.index')->with('success','data berhasil ditambahkan');
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
        $user=PemerintahanSahbandar::find($id);
        return view('pemerintahan-sahbandar.edit',[
                    "data"=>$user,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PemerintahanSahbandarRequest $request, string $id)
    {
        $user=PemerintahanSahbandar::find($id)->update($request->all());
        return redirect()->route('pemerintahan-sahbandar.index')->with('success','data berhasil diubah'); 
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
