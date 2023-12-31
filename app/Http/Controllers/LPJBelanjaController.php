<?php

namespace App\Http\Controllers;

use App\DataTables\LPJBelanjaDataTable;
use App\Models\LPJBelanja;
use Illuminate\Http\Request;

class LPJBelanjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(String $id)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id=$request->id;
        LPJBelanja::create($request->all());
        return redirect()->route('lpj-belanja.show/{{$id}}')->with('success','Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(LPJBelanjaDataTable $dataTable)
    {
           return $dataTable->render('lpj-belanja.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LPJBelanja $lPJBelanja)
    {
        dd("show");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LPJBelanja $lPJBelanja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LPJBelanja $lPJBelanja)
    {
        //
    }
}
