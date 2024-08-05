<?php

namespace App\Http\Controllers;

use App\DataTables\Scopes\SirkulasiMelahirkanScope;
use App\DataTables\SirkulasiMelahirkanDatatable;
use App\Exports\SirkulasiMelahirkanExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataMelahirkanFormRequest;
use App\Models\Penduduk;
use App\Models\SirkulasiMelahirkan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class SirkulasiMelahirkanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SirkulasiMelahirkanDatatable $dataTable, Request $request)
    {
        if ($dataTable->request()->action == 'pdf') {

            return redirect()->route('sirkulasi-melahirkan.generate-pdf', [$request]);
        }

        if ($dataTable->request()->action != null) {
            return Excel::download(new SirkulasiMelahirkanExport($request), 'sirkulasi-melahirkan-' . date('Y-m-d H:i:s') . ($dataTable->request()->action == 'excel' ? '.xlsx' : '.csv'));
        }
        return $dataTable->addScope(new SirkulasiMelahirkanScope($request))->render('sirkulasi-melahirkan.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua penduduk yang belum ada di sirkulasi_pindah
        $data = Penduduk::whereDoesntHave('sirkulasiPindah')->get();

        return view('sirkulasi-melahirkan.create', [
            "data" => $data,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(DataMelahirkanFormRequest $request)
    {
        $userId = auth()->user()->id;

        $data = $request->all();
        $data['user_id'] = $userId;

        SirkulasiMelahirkan::create($data);

        return redirect()->route('sirkulasi-melahirkan.index')->with('success', 'Data berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = SirkulasiMelahirkan::findOrFail($id);

        // Ambil semua penduduk yang belum ada di sirkulasi_pindah, kecuali penduduk yang saat ini sedang diedit
        $dataPenduduk = Penduduk::whereDoesntHave('sirkulasiPindah', function ($query) use ($data) {
            $query->where('penduduk_id', '!=', $data->penduduk_id);
        })->get();

        return view('sirkulasi-melahirkan.edit', [
            'data' => $data,
            'dataPenduduk' => $dataPenduduk
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(DataMelahirkanFormRequest $request, string $id)
    {
        $sirkulasiMelahirkan = SirkulasiMelahirkan::findOrFail($id);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        $sirkulasiMelahirkan->update($data);

        return redirect()->route('sirkulasi-melahirkan.index')->with('success', 'Data berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = SirkulasiMelahirkan::find($id)->delete();
        return redirect()->route('sirkulasi-melahirkan.index')->with('success', 'Data berhasil dihapus');

    }

    public function pdfTemplate(SirkulasiMelahirkanDataTable $dataTable, Request $request)
    {
        // Retrieve the query builder instance for Sirkulasi Melahirkan data
        $query = $dataTable->query(new SirkulasiMelahirkan());

        // Apply the date range filter
        if ($request->has('tgl_lahir_start') && $request->has('tgl_lahir_end')) {
            $query->whereBetween('sirkulasi_melahirkans.tgl_lahir', [$request->get('tgl_lahir_start'), $request->get('tgl_lahir_end')]);
        }

        // Retrieve the filtered data
        $data = $query->get();

        // Send data to the view for PDF rendering
        $html = view('sirkulasi-melahirkan.generate-pdf', ['data' => $data])->render();

        // Adjust PDF options including setting paper to landscape
        $pdf = PDF::loadHtml($html)->setPaper('a4', 'landscape');

        return $pdf->stream('SirkulasiMelahirkan.pdf');
    }




}
