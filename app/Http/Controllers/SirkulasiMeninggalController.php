<?php

namespace App\Http\Controllers;

use App\DataTables\Scopes\SirkulasiMeninggalScope;
use App\DataTables\SirkulasiMeninggalDatatable;
use App\Exports\SirkulasiMeninggalExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataMeninggalFormRequest;
use App\Models\Penduduk;
use App\Models\SirkulasiMeninggal;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;



class SirkulasiMeninggalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SirkulasiMeninggalDataTable $dataTable, Request $request)
    {

        if ($dataTable->request()->action == 'pdf') {

            return redirect()->route('sirkulasi-meninggal.generate-pdf', [$request]);
        }

        if ($dataTable->request()->action != null) {
            return Excel::download(new SirkulasiMeninggalExport($request), 'sirkulasi-meninggal-' . date('Y-m-d H:i:s') . ($dataTable->request()->action == 'excel' ? '.xlsx' : '.csv'));
        }
        return $dataTable->addScope(new SirkulasiMeninggalScope($request))->render('sirkulasi-meninggal.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil ID penduduk yang sudah ada di sirkulasi_meninggal
        $existingPendudukIds = SirkulasiMeninggal::pluck('penduduk_id')->toArray();

        // Ambil penduduk yang tidak ada di sirkulasi_meninggal
        $data = Penduduk::whereNotIn('id', $existingPendudukIds)->get()->unique('NIK');

        return view('sirkulasi-meninggal.create', [
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DataMeninggalFormRequest $request)
    {
        $userId = auth()->user()->id;

        $data = $request->all();
        $data['user_id'] = $userId;

        SirkulasiMeninggal::create($data);

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
        // Ambil data Sirkulasimeninggal yang akan diedit
        $data = SirkulasiMeninggal::findOrFail($id);

        // Ambil ID penduduk yang sudah ada di sirkulasi_meninggal
        $existingPendudukIds = SirkulasiMeninggal::pluck('penduduk_id')->toArray();

        // Ambil penduduk yang tidak ada di sirkulasi_meninggal
        $dataPenduduk = Penduduk::whereNotIn('id', $existingPendudukIds)->get()->unique('NIK');

        return view('sirkulasi-meninggal.edit', [
            'data' => $data,
            'dataPenduduk' => $dataPenduduk,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(DataMeninggalFormRequest $request, string $id)
    {
        // Temukan instance Sirkulasimeninggal yang akan diperbarui
        $sirkulasimeninggal = SirkulasiMeninggal::findOrFail($id);

        // Ambil data dari request
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        // Perbarui data Sirkulasimeninggal
        $sirkulasimeninggal->update($data);

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

    public function pdfTemplate(SirkulasiMeninggalDatatable $dataTable,  Request $request)
    {
          // Retrieve the query builder instance for Sirkulasi Memeninggalkan data
          $query = $dataTable->query(new SirkulasiMeninggal());

          // Apply the date range filter
          if ($request->has('tgl_meninggal_start') && $request->has('tgl_meninggal_end')) {
              $query->whereBetween('sirkulasi_meninggal.tgl_meninggal', [$request->get('tgl_meninggal_start'), $request->get('tgl_meninggal_end')]);
          }
  
          // Retrieve the filtered data
          $data = $query->get();
  
          // Send data to the view for PDF rendering
          $html = view('sirkulasi-meninggal.generate-pdf', ['data' => $data])->render();
  
          // Adjust PDF options including setting paper to landscape
          $pdf = PDF::loadHtml($html)->setPaper('a4', 'landscape');

        return $pdf->stream('SirkulasiMeninggal.pdf');
    }
}
