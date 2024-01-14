<?php

namespace App\Http\Controllers;

use App\DataTables\LPJTimPemeriksaDataTable;
use App\Models\LPJTimPemeriksa;
use Illuminate\Http\Request;

class LPJTimPemeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LPJTimPemeriksaDataTable $dataTable)
    {
        return $dataTable->render('lpj-timpemeriksa.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LPJTimPemeriksa $lPJTimPemeriksa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LPJTimPemeriksa $lPJTimPemeriksa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LPJTimPemeriksa $lPJTimPemeriksa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LPJTimPemeriksa $lPJTimPemeriksa)
    {
        //
    }
}
