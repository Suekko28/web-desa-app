<?php

namespace App\Http\Controllers;

use App\DataTables\SirkulasiMeninggalDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataMeninggalFormRequest;
use App\Models\Penduduk;
use App\Models\SirkulasiMeninggal;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;



class SirkulasiMeninggalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SirkulasiMeninggalDataTable $dataTable)
    {

        return $dataTable->render('sirkulasi-meninggal.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Penduduk::all();
        return view('sirkulasi-meninggal.create', [
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DataMeninggalFormRequest $request)
    {
        $penduduk = Penduduk::where('NIK', $request->NIK_penduduk)->firstOrFail();
        $penduduk->delete();

        SirkulasiMeninggal::create($request->all());

        return redirect()->route('sirkulasi-meninggal.index')->with('success', 'Data berhasil ditambahkan dan data penduduk terkait telah dihapus');
    }

    /**
     * Display the specified resource.
     */
    public function show(SirkulasiMeninggal $sirkulasiMeninggal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = SirkulasiMeninggal::find($id);
        $nkk = $data->NIK_penduduk;
        $data['nama'] = Penduduk::where('NIK', '=', $nkk)->first()->nama;
        $data_penduduk = Penduduk::all();

        return view('sirkulasi-meninggal.edit', [
            'data' => $data,
            'data_penduduk' => $data_penduduk,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DataMeninggalFormRequest $request, string $id)
    {
        $data = SirkulasiMeninggal::find($id);

        $data->update($request->all());
        return redirect()->route('sirkulasi-meninggal.index')->with('success', 'Data berhasil diupdate');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = SirkulasiMeninggal::find($id)->delete();
        return redirect()->route('sirkulasi-meninggal.index')->with('success', 'Data berhasil dihapus');

    }

    public function pdfTemplate(SirkulasiMeninggalDatatable $dataTable)
    {
        // Retrieve the data directly from the query builder
        $data = $dataTable->query(new SirkulasiMeninggal())->get();

        // Send data to the view for PDF rendering
        $html = view('sirkulasi-meninggal.generate-pdf', ['data' => $data])->render();

        // Adjust PDF options including setting paper to landscape
        $pdf = PDF::loadHtml($html)->setPaper('a4', 'landscape');

        return $pdf->stream('SirkulasiMeninggal.pdf');
    }
}
