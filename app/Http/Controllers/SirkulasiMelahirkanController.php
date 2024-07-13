<?php

namespace App\Http\Controllers;

use App\DataTables\Scopes\SirkulasiMelahirkanScope;
use App\DataTables\SirkulasiMelahirkanDatatable;
use App\Exports\SirkulasiMelahirkanExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataMelahirkanFormRequest;
use App\Models\Penduduk;
use App\Models\Anak;
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
        $data = Penduduk::all()->unique('NKK');
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

        Anak::create($data);

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
        $data = Anak::find($id);
        $nkk = $data->NKK_keluarga;
        $data_keluarga = Penduduk::where('NKK', '=', $nkk)->first();
        $data_penduduk = Penduduk::all();

        return view('sirkulasi-melahirkan.edit', [
            "data" => $data,
            "data_keluarga" => $data_keluarga,
            "data_penduduk" => $data_penduduk,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DataMelahirkanFormRequest $request, string $id)
    {
        $userId = auth()->user()->id;

        $data = $request->all();
        $data['user_id'] = $userId;

        $anak = Anak::find($id);
        $anak->update($data);
        
        return redirect()->route('sirkulasi-melahirkan.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Anak::find($id)->delete();
        return redirect()->route('sirkulasi-melahirkan.index')->with('success', 'Data berhasil dihapus');

    }

    public function pdfTemplate(SirkulasiMelahirkanDatatable $dataTable)
    {
        // Retrieve the data directly from the query builder
        $data = $dataTable->query(new Anak())->get();

        // Send data to the view for PDF rendering
        $html = view('sirkulasi-melahirkan.generate-pdf', ['data' => $data])->render();

        // Adjust PDF options including setting paper to landscape
        $pdf = PDF::loadHtml($html)->setPaper('a4', 'landscape');

        return $pdf->stream('SirkulasiMelahirkan.pdf');
    }
}
