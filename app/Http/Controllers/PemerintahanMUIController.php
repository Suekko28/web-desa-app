<?php

namespace App\Http\Controllers;

use App\DataTables\PemerintahanMUIDataTable;
use App\Http\Requests\PemerintahanMUIRequest;
use App\Models\PemerintahanMUI;

class PemerintahanMUIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PemerintahanMUIDataTable $dataTable)
    {
        return $dataTable->render('pemerintahan-mui.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemerintahan-mui.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PemerintahanMUIRequest $request)
    {
        $data=$request->all();
        PemerintahanMUI::create($data);
        return redirect()->route('pemerintahan-mui.index')->with('success','data berhasil ditambahkan');
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
        $user=PemerintahanMUI::find($id);
        return view('pemerintahan-mui.edit',[
                    "data"=>$user,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PemerintahanMUIRequest $request, string $id)
    {
        $user=PemerintahanMUI::find($id)->update($request->all());
        return redirect()->route('pemerintahan-mui.index')->with('success','data berhasil diubah'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=PemerintahanMUI::find($id)->delete();
        return redirect()->route('pemerintahan-mui.index')->with('success','data berhasil dihapus'); 
    }
}
