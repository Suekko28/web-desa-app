<?php

namespace App\Http\Controllers;

use App\DataTables\Scopes\SirkulasiPendatangScope;
use App\DataTables\SirkulasiPendatangDataTable;
use App\Exports\SirkulasiPendatangExport;
use App\Http\Requests\DataPendatangFormRequest;
use App\Models\SirkulasiPendatang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class SirkulasiPendatangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SirkulasiPendatangDataTable $dataTable, Request $request)
    {
        if ($dataTable->request()->action == 'pdf') {

            return redirect()->route('sirkulasi-pendatang.generate-pdf', [$request]);
        }

        if ($dataTable->request()->action != null) {
            return Excel::download(new SirkulasiPendatangExport($request), 'sirkulasi-pendatang-' . date('Y-m-d H:i:s') . ($dataTable->request()->action == 'excel' ? '.xlsx' : '.csv'));
        }
        return $dataTable->addScope(new SirkulasiPendatangScope($request))->render('sirkulasi-pendatang.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sirkulasi-pendatang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DataPendatangFormRequest $request)
    {
        $data = $request->all();
        SirkulasiPendatang::create($data);
        return redirect()->route('sirkulasi-pendatang.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(SirkulasiPendatang $dataPendatang)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = SirkulasiPendatang::find($id);
        return view('sirkulasi-pendatang.edit', [
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang diperbarui
        $validatedData = $request->all();

        // Temukan data SirkulasiPendatang berdasarkan ID
        $data = SirkulasiPendatang::findOrFail($id);

        // Update data dengan data yang diperbarui
        $data->update($validatedData);

        return redirect()->route('sirkulasi-pendatang.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = SirkulasiPendatang::find($id)->delete();
        return redirect()->route('sirkulasi-pendatang.index')->with('success', 'Data berhasil dihapus');

    }

    public function pdfTemplate(SirkulasiPendatangDataTable $dataTable, Request $request)
    {
        // Retrieve the query builder instance for Sirkulasi pendatang data
        $query = $dataTable->query(new SirkulasiPendatang());

        // Apply the date range filter
        if ($request->has('tgl_datang_start') && $request->has('tgl_datang_end')) {
            $query->whereBetween('sirkulasi_pendatang.tgl_datang', [$request->get('tgl_datang_start'), $request->get('tgl_datang_end')]);
        }

        // Retrieve the filtered data
        $data = $query->get();

        // Send data to the view for PDF rendering
        $html = view('sirkulasi-pendatang.generate-pdf', ['data' => $data])->render();

        // Adjust PDF options including setting paper to landscape
        $pdf = PDF::loadHtml($html)->setPaper('a4', 'landscape');

        return $pdf->stream('SirkulasiPendatang.pdf');
    }

}
