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
        $data_penduduk = Penduduk::all();
        return view('sirkulasi-pindah.create', [
            'data_penduduk' => $data_penduduk,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DataPindahFormRequest $request)
    {
        // Ambil data penduduk berdasarkan NIK
        $penduduk = Penduduk::where('NIK', $request->NIK)->firstOrFail();

        // Gabungkan Nama dan NIK untuk disimpan atau ditampilkan
        $infoPenduduk = $penduduk->nama;

        // Simpan informasi sirkulasi pindah dengan informasi nama penduduk
        SirkulasiPindah::create([
            'nama_penduduk' => $infoPenduduk,
            'NIK' => $request->NIK,
            'tgl_pindah' => $request->tgl_pindah,
            'alasan' => $request->alasan,
            'alamat_pindah' => $request->alamat_pindah,
            'user_id' => auth()->id(),
        ]);

        // Hapus penduduk setelah data sirkulasi pindah disimpan
        $penduduk->delete();

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
    public function edit(string $id)
    {
        // Cari data sirkulasiPindah berdasarkan ID
        $sirkulasiPindah = SirkulasiPindah::find($id);

        // Jika data tidak ditemukan, bisa berikan respons sesuai kebijakan aplikasi
        if (!$sirkulasiPindah) {
            abort(404); // Contoh: tampilkan halaman 404
        }

        // Ambil NIK penduduk dari data sirkulasiPindah
        $nikPenduduk = $sirkulasiPindah->NIK;

        // Cari nama penduduk berdasarkan NIK dari data sirkulasiPindah
        $namaPenduduk = Penduduk::where('NIK', $nikPenduduk)->value('nama');

        // Ambil semua data Penduduk untuk pilihan dropdown
        $dataPenduduk = Penduduk::all();

        return view('sirkulasi-pindah.edit', [
            'data' => $sirkulasiPindah,
            'nama' => $namaPenduduk,
            'data_penduduk' => $dataPenduduk,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DataPindahFormRequest $request, string $id)
    {
        // Cari data sirkulasiPindah berdasarkan ID
        $sirkulasiPindah = SirkulasiPindah::find($id);

        // Jika data tidak ditemukan, bisa berikan respons sesuai kebijakan aplikasi
        if (!$sirkulasiPindah) {
            abort(404); // Contoh: tampilkan halaman 404
        }

        // Ambil data penduduk berdasarkan NIK dari request
        $penduduk = Penduduk::where('NIK', $request->NIK)->firstOrFail();

        // Update informasi sirkulasi pindah
        $sirkulasiPindah->update([
            'nama_penduduk' => $penduduk->nama,
            'NIK' => $request->NIK,
            'tgl_pindah' => $request->tgl_pindah,
            'sebab' => $request->sebab,
            'user_id' => auth()->id(),
        ]);

        // Hapus penduduk terkait setelah update data sirkulasi pindah
        $penduduk->delete();
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
