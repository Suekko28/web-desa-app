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
        // Ambil data penduduk berdasarkan NIK
        $penduduk = Penduduk::where('NIK', $request->NIK_penduduk)->firstOrFail();

        // Gabungkan Nama dan NIK untuk disimpan atau ditampilkan
        $infoPenduduk = $penduduk->nama;

        // Simpan informasi sirkulasi meninggal dengan informasi nama penduduk
        SirkulasiMeninggal::create([
            'nama_penduduk' => $infoPenduduk,
            'NIK_penduduk' => $request->NIK_penduduk,
            'tgl_meninggal' => $request->tgl_meninggal,
            'sebab' => $request->sebab,
            'user_id' => auth()->id(),
        ]);

        // Hapus penduduk setelah data sirkulasi meninggal disimpan
        $penduduk->delete();

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
        // Cari data SirkulasiMeninggal berdasarkan ID
        $sirkulasiMeninggal = SirkulasiMeninggal::find($id);

        // Jika data tidak ditemukan, bisa berikan respons sesuai kebijakan aplikasi
        if (!$sirkulasiMeninggal) {
            abort(404); // Contoh: tampilkan halaman 404
        }

        // Ambil NIK penduduk dari data SirkulasiMeninggal
        $nikPenduduk = $sirkulasiMeninggal->NIK_penduduk;

        // Cari nama penduduk berdasarkan NIK dari data SirkulasiMeninggal
        $namaPenduduk = Penduduk::where('NIK', $nikPenduduk)->value('nama');

        // Ambil semua data Penduduk untuk pilihan dropdown
        $dataPenduduk = Penduduk::all();

        return view('sirkulasi-meninggal.edit', [
            'data' => $sirkulasiMeninggal,
            'nama_penduduk' => $namaPenduduk,
            'data_penduduk' => $dataPenduduk,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(DataMeninggalFormRequest $request, string $id)
    {
        // Cari data SirkulasiMeninggal berdasarkan ID
        $sirkulasiMeninggal = SirkulasiMeninggal::find($id);

        // Jika data tidak ditemukan, bisa berikan respons sesuai kebijakan aplikasi
        if (!$sirkulasiMeninggal) {
            abort(404); // Contoh: tampilkan halaman 404
        }

        // Ambil data penduduk berdasarkan NIK dari request
        $penduduk = Penduduk::where('NIK', $request->NIK_penduduk)->firstOrFail();

        // Update informasi sirkulasi meninggal
        $sirkulasiMeninggal->update([
            'nama_penduduk' => $penduduk->nama,
            'NIK_penduduk' => $request->NIK_penduduk,
            'tgl_meninggal' => $request->tgl_meninggal,
            'sebab' => $request->sebab,
            'user_id' => auth()->id(),
        ]);

        // Hapus penduduk terkait setelah update data sirkulasi meninggal
        $penduduk->delete();

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
