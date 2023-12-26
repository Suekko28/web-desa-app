<?php

namespace App\Http\Controllers;

use App\DataTables\SirkulasiMelahirkanDatatable;
use App\Models\SirkulasiMelahirkan;
use Illuminate\Http\Request;

class SirkulasiMelahirkanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SirkulasiMelahirkanDatatable $dataTable)
    {
        return $dataTable->render('sirkulasi-melahirkan.index');

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
    public function show(SirkulasiMelahirkan $sirkulasiMelahirkan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SirkulasiMelahirkan $sirkulasiMelahirkan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SirkulasiMelahirkan $sirkulasiMelahirkan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SirkulasiMelahirkan $sirkulasiMelahirkan)
    {
        //
    }
}
