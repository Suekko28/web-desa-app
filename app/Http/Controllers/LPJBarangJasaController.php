<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\DataTables\LPJBarangJasaDataTable;
use App\Http\Requests\PemerintahanLPJRequest;
use App\Models\LPJBarangJasa;
use App\Models\LPJTimPemeriksa;
use App\Models\LPJBelanja;
use App\Models\LPJKegiatan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Riskihajar\Terbilang\Facades\Terbilang;

class LPJBarangJasaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LPJBarangJasaDataTable $dataTable)
    {

        return $dataTable->render('lpj-barangjasa.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // // Ambil ID penduduk yang sudah ada di sirkulasi_pindah
        // $existingTimPemeriksaIds = LPJBarangJasa::pluck('timpemeriksa_id')->toArray();

        // // Ambil penduduk yang tidak ada di sirkulasi_pindah
        // $data_pemeriksa = LPJTimPemeriksa::whereNotIn('id', $existingTimPemeriksaIds)->get()->unique('NIP');

        $data_pemeriksa = LPJTimPemeriksa::all();
        return view('lpj-barangjasa.create', ['data_pemeriksa' => $data_pemeriksa]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PemerintahanLPJRequest $request)
    {
        $data = $request->all();
        $userId = auth()->user()->id;

        $data['user_id'] = $userId;

        LPJBarangJasa::create($data);

        return redirect()->route('lpj-barangjasa.index')->with('success', 'Data berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = LPJBarangJasa::find($id);
        $data_pemeriksa = LPJTimPemeriksa::find($data->timpemeriksa_id);

        return view('lpj-barangjasa.view', [
            "data" => $data,
            "data_pemeriksa" => $data_pemeriksa,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = LPJBarangJasa::find($id);

        $data_pemeriksa = LPJTimPemeriksa::all();



        return view('lpj-barangjasa.edit', [
            "data" => $data,
            "data_pemeriksa" => $data_pemeriksa,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(PemerintahanLPJRequest $request, string $id)
    {
        // Ambil ID user yang sedang login
        $userId = auth()->user()->id;

        // Temukan data LPJBarangJasa berdasarkan ID yang diberikan
        $lpjBarangJasa = LPJBarangJasa::find($id);

        // Validasi data yang diterima dari request
        $validatedData = $request->validated();

        // Tambahkan user_id ke dalam data yang akan diupdate
        $validatedData['user_id'] = $userId;

        // Lakukan update data LPJBarangJasa dengan data yang telah divalidasi dan user_id
        $lpjBarangJasa->update($validatedData);

        // Redirect kembali ke halaman indeks lpj-barangjasa dengan pesan sukses
        return redirect()->route('lpj-barangjasa.index')->with('success', 'Data berhasil diubah');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $user = LPJBarangJasa::find($id)->delete();
        $anak = LPJBelanja::where('id_barang_jasa', '=', $id)->delete();
        return redirect()->route('lpj-barangjasa.index')->with('success', 'Data berhasil dihapus');

    }

    // public function pdfTemplate(LPJBarangJasaDataTable $dataTable)
    // {
    //     // Retrieve the data directly from the query builder
    //     $date = date('Y-m-d');
    //     $tanggal = Terbilang::date($date);
    //     $hari = Carbon::now()->isoFormat('dddd');
    //     $tahun = Carbon::now()->isoFormat('Y');

    //     $data = $dataTable->query(new LPJBarangJasa())->get();
    //     $data_belanja = LPJBarangJasa::find($data->first()->id);

    //     $data_barang = $data_belanja->LPJBelanja()->get();
    //     // Send data to the view for PDF rendering
    //     if (sizeof($data_barang) == 0) {
    //         return redirect()->route('lpj-barangjasa.index')->with('error', "Tidak ada data belanja untuk toko ini");
    //     }
    //     $date_pesanan = $data->first()->tgl_pesanan;
    //     $date_pesanan = strtotime($date_pesanan);
    //     $tahun_terbilang = Terbilang::make(date('Y'));

    //     $bulan_pesanan_terbilang = Carbon::create()->month(date('m', $date_pesanan))->isoFormat('MMMM');
    //     $tahun_pesanan = Carbon::create()->year(date('Y', $date_pesanan))->isoFormat('Y');
    //     $date_pesanan = date('d', $date_pesanan) . ' ' . $bulan_pesanan_terbilang . ' ' . $tahun_pesanan;

    //     $date_pemeriksa = LPJTimPemeriksa::first()->tgl_pemeriksa;
    //     $date_pemeriksa = strtotime($date_pemeriksa);
    //     $tahun_terbilang = Terbilang::make(date('Y'));

    //     $bulan_pesanan_terbilang = Carbon::create()->month(date('m', $date_pemeriksa))->isoFormat('MMMM');
    //     $tahun_pesanan = Carbon::create()->year(date('Y', $date_pemeriksa))->isoFormat('Y');
    //     $date_pemeriksa = date('d', $date_pemeriksa) . ' ' . $bulan_pesanan_terbilang . ' ' . $tahun_pesanan;



    //     $data_pemeriksa = LPJTimPemeriksa::where('NIP', '=', $data->first()->tim_pemeriksa)->get();
    //     $data_anggota_pemeriksa = $data_pemeriksa->first()->AnggotaLPJTimPemeriksa()->get();
    //     $html = view('lpj-barangjasa.generate-pdf', ['date_pemeriksa' => $date_pemeriksa, 'tahun' => $tahun_terbilang, 'date_pesanan' => $date_pesanan, 'hari' => $hari, 'tanggal_hari_ini' => $tanggal, 'data_anggota_pemeriksa' => $data_anggota_pemeriksa, 'data_pemeriksa' => $data_pemeriksa->first(), 'data' => $data, 'data_belanja' => $data_belanja, 'data_barang' => $data_barang])->render();


    //     // Adjust PDF options if needed
    //     $pdf = PDF::loadHtml($html)->setPaper('f4', 'landscape');

    //     return $pdf->stream('LPJBarangJasa.pdf');
    // }
}
