<?php

namespace App\Http\Controllers;

use App\DataTables\SirkulasiPindahDataTable;
use App\Models\SirkulasiPindah;
use Illuminate\Http\Request;
use App\Models\Penduduk;
use Barryvdh\DomPDF\Facade\Pdf;


class SirkulasiPindahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SirkulasiPindahDataTable $dataTable)
    {
        return $dataTable->render('sirkulasi-pindah.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data_penduduk=Penduduk::all();
        return view('sirkulasi-pindah.create',[
            'data_penduduk'=>$data_penduduk,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user=SirkulasiPindah::create($request->all());
        return redirect()->route('sirkulasi-pindah.index')->with('success','Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(SirkulasiPindah $sirkulasiPindah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $data=SirkulasiPindah::find($id);
        $data_penduduk=Penduduk::all();
        $nama=Penduduk::where('NIK','=',$data->NIK)->first()->nama;
        return view('sirkulasi-pindah.edit',[
            'data'=>$data,
            'data_penduduk'=>$data_penduduk,
            'nama'=>$nama,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $data=SirkulasiPindah::find($id);
        $data->update($request->all());
        return redirect()->route('sirkulasi-pindah.index')->with('success','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $data=SirkulasiPindah::find($id)->delete();
        return redirect()->route('sirkulasi-pindah.index')->with('success','Data berhasil dihapus');
    }

    public function pdfTemplate(SirkulasiPindahDataTable $dataTable)
    {
        // Retrieve the data directly from the query builder
        $data = $dataTable->query(new SirkulasiPindah())->get();
    
        // Send data to the view for PDF rendering
        $html = view('sirkulasi-pindah.generate-pdf', ['data' => $data])->render();
   
        // Adjust PDF options including setting paper to landscape
        $pdf = PDF::loadHtml($html)->setPaper('a4', 'landscape');
    
        return $pdf->stream('SirkulasiPindah.pdf');
    }
}
