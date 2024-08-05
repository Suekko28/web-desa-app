<?php

namespace App\Http\Controllers;

use App\DataTables\Scopes\SirkulasiPindahScope;
use App\DataTables\SirkulasiPindahDataTable;
use App\Exports\SirkulasiPindahExport;
use App\Http\Requests\DataPindahFormRequest;
use App\Models\SirkulasiPindah;
use Illuminate\Http\Request;
use App\Models\Penduduk;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;


class SirkulasiPindahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SirkulasiPindahDataTable $dataTable, Request $request)
    {
        if ($dataTable->request()->action == 'pdf') {

            return redirect()->route('sirkulasi-pindah.generate-pdf', [$request]);
        }

        if ($dataTable->request()->action != null) {
            return Excel::download(new SirkulasiPindahExport($request), 'sirkulasi-pindah-' . date('Y-m-d H:i:s') . ($dataTable->request()->action == 'excel' ? '.xlsx' : '.csv'));
        }
        return $dataTable->addScope(new SirkulasiPindahScope($request))->render('sirkulasi-pindah.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil ID penduduk yang sudah ada di sirkulasi_pindah
        $existingPendudukIds = SirkulasiPindah::pluck('penduduk_id')->toArray();

        // Ambil penduduk yang tidak ada di sirkulasi_pindah
        $data = Penduduk::whereNotIn('id', $existingPendudukIds)->get()->unique('NIK');

        return view('sirkulasi-pindah.create', [
            'data' => $data,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(DataPindahFormRequest $request)
    {
        $userId = auth()->user()->id;

        $data = $request->all();
        $data['user_id'] = $userId;

        SirkulasiPindah::create($data);

        return redirect()->route('sirkulasi-pindah.index')->with('success', 'Data Berhasil Ditambahkan');
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
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Ambil data SirkulasiPindah yang akan diedit
        $data = SirkulasiPindah::findOrFail($id);

        // Ambil ID penduduk yang sudah ada di sirkulasi_pindah
        $existingPendudukIds = SirkulasiPindah::pluck('penduduk_id')->toArray();

        // Ambil penduduk yang tidak ada di sirkulasi_pindah
        $dataPenduduk = Penduduk::whereNotIn('id', $existingPendudukIds)->get()->unique('NIK');

        return view('sirkulasi-pindah.edit', [
            'data' => $data,
            'dataPenduduk' => $dataPenduduk,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(DataPindahFormRequest $request, string $id)
    {
        // Temukan instance SirkulasiPindah yang akan diperbarui
        $sirkulasiPindah = SirkulasiPindah::findOrFail($id);

        // Ambil data dari request
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        // Perbarui data SirkulasiPindah
        $sirkulasiPindah->update($data);

        return redirect()->route('sirkulasi-pindah.index')->with('success', 'Data berhasil diupdate');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = SirkulasiPindah::find($id)->delete();
        return redirect()->route('sirkulasi-pindah.index')->with('success', 'Data berhasil dihapus');
    }

    public function pdfTemplate(SirkulasiPindahDataTable $dataTable, Request $request)
    {
        // Retrieve the query builder instance for Sirkulasi Mepindahkan data
        $query = $dataTable->query(new SirkulasiPindah());

        // Apply the date range filter
        if ($request->has('tgl_pindah_start') && $request->has('tgl_pindah_end')) {
            $query->whereBetween('sirkulasi_pindah.tgl_pindah', [$request->get('tgl_pindah_start'), $request->get('tgl_pindah_end')]);
        }

        // Retrieve the filtered data
        $data = $query->get();

        // Send data to the view for PDF rendering
        $html = view('sirkulasi-pindah.generate-pdf', ['data' => $data])->render();

        // Adjust PDF options including setting paper to landscape
        $pdf = PDF::loadHtml($html)->setPaper('a4', 'landscape');

        return $pdf->stream('SirkulasiPindah.pdf');
    }
}
