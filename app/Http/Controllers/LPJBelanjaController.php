<?php

namespace App\Http\Controllers;

use App\DataTables\LPJBelanjaDataTable;
use App\Models\LPJBarangJasa;
use App\Models\LPJTimPemeriksa;
use App\Models\LPJBelanja;
use App\Models\LPJKegiatan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Riskihajar\Terbilang\Facades\Terbilang;
use Carbon\Carbon;

class LPJBelanjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id, Request $request)
    {
        $data_pemeriksa = LPJTimPemeriksa::all();

        return view('lpj-belanja.create', [
            'id' => $id,
            'data_pemeriksa' => $data_pemeriksa,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'volume_qty' => 'required|integer',
            'satuan' => 'required|string|max:255',
            'harga' => 'required|integer',
        ], [
            'nama_barang.required' => 'Nama Barang wajib diisi.',
            'volume_qty.required' => 'Volume Quantity wajib diisi.',
            'satuan.required' => 'Satuan wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
        ]);

        // Ambil ID pengguna yang sedang login
        $userId = auth()->user()->id;

        // Tambahkan user_id ke dalam data yang akan disimpan
        $validatedData['user_id'] = $userId;

        // Tambahkan id_barang_jasa berdasarkan request id ke dalam data yang akan disimpan
        $validatedData['id_barang_jasa'] = $request->id;

        // Simpan data LPJBelanja berdasarkan data yang sudah divalidasi
        LPJBelanja::create($validatedData);

        // Redirect kembali ke halaman show lpj-belanja dengan id yang sesuai dan pesan sukses
        return redirect()->route('lpj-belanja.show', ['lpj_belanja' => $request->id])->with('success', 'Data berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $dataTable = new LPJBelanjaDataTable($id);
        return $dataTable->render('lpj-belanja.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_barang_jasa, string $id)
    {
        $data = LPJBelanja::where('id', '=', $id)->where('id_barang_jasa', '=', $id_barang_jasa)->first();
        $data_pemeriksa = LPJTimPemeriksa::all();

        // Ambil nama pemeriksa jika ada
        $data_pemeriksa_nama = LPJTimPemeriksa::where('NIP', '=', $data['tim_pemeriksa'])->first();
        if ($data_pemeriksa_nama) {
            $data['nama_pemeriksa'] = $data_pemeriksa_nama->nama;
        } else {
            $data['nama_pemeriksa'] = null; // Nilai default jika tidak ditemukan
        }

        return view('lpj-belanja.edit', [
            'data' => $data,
            'id' => $id,
            'data_pemeriksa' => $data_pemeriksa,
            'id_barang_jasa' => $id_barang_jasa,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_barang_jasa, string $id)
    {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'volume_qty' => 'required|integer',
            'satuan' => 'required|string|max:255',
            'harga' => 'required|integer',
        ], [
            'nama_barang.required' => 'Nama Barang wajib diisi.',
            'volume_qty.required' => 'Volume Quantity wajib diisi.',
            'satuan.required' => 'Satuan wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
        ]);

        // Ambil ID pengguna yang sedang login
        $userId = auth()->user()->id;

        // Tambahkan user_id ke dalam data yang akan diperbarui
        $validatedData['user_id'] = $userId;

        // Perbarui data LPJBelanja berdasarkan id yang diberikan
        LPJBelanja::find($id)->update($validatedData);

        // Redirect kembali ke halaman show lpj-belanja dengan id_barang_jasa yang sesuai dan pesan sukses
        return redirect()->route('lpj-belanja.show', ['lpj_belanja' => $id_barang_jasa])->with('success', 'Berhasil mengubah data');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_barang_jasa, string $id)
    {
        $user = LPJBelanja::find($id)->delete();
        return redirect()->route('lpj-belanja.show', ['lpj_belanja' => $id_barang_jasa])->with('success', 'Berhasil menghapus data');
    }

    public function pdfTemplate(LPJBelanjaDataTable $dataTable, string $id)
    {

        // Retrieve the data directly from the query builder
        $date = date('Y-m-d');
        $tanggal = Terbilang::date($date);
        $tanggalProperCase = ucwords($tanggal);
        $hari = Carbon::now()->isoFormat('dddd');
        $tahun = Carbon::now()->isoFormat('Y');

        $data = $dataTable->query(new LPJBelanja())->get();
        $data_belanja = LPJBarangJasa::find($id);

        $data_barang = $data_belanja->LPJBelanja()->get();
        // Send data to the view for PDF rendering
        if (sizeof($data_barang) == 0) {
            return redirect()->route('lpj-barangjasa.index')->with('error', "Tidak ada data belanja untuk toko ini");
        }
        $date_pesanan = LPJBarangJasa::first()->tgl_pesanan;
        $date_pesanan = strtotime($date_pesanan);
        $tahun_terbilang = Terbilang::make(date('Y'));

        $bulan_pesanan_terbilang = Carbon::create()->month(date('m', $date_pesanan))->isoFormat('MMMM');
        $tahun_pesanan = Carbon::create()->year(date('Y', $date_pesanan))->isoFormat('Y');
        $date_pesanan = date('d', $date_pesanan) . ' ' . $bulan_pesanan_terbilang . ' ' . $tahun_pesanan;

        // Date Format DD-MM-YYYY
        $date_pemeriksa = LPJTimPemeriksa::first()->tgl_pemeriksa;
        $date_pemeriksa = strtotime($date_pemeriksa);
        $tahun_terbilang = Terbilang::make(date('Y'));


        $bulan_pesanan_terbilang = Carbon::create()->month(date('m', $date_pemeriksa))->isoFormat('MMMM');
        $tahun_pesanan = Carbon::create()->year(date('Y', $date_pemeriksa))->isoFormat('Y');
        $date_pemeriksa_format = date('d', $date_pemeriksa) . ' ' . $bulan_pesanan_terbilang . ' ' . $tahun_pesanan;

        // Date Pada Hari ini
        $date_pemeriksa = LPJTimPemeriksa::first()->tgl_pemeriksa;
        $date_pemeriksa = Carbon::parse($date_pemeriksa);
        $date_pemeriksa_hari = $date_pemeriksa->isoFormat('dddd');

        $date_pemeriksa = LPJTimPemeriksa::first()->tgl_pemeriksa;
        $date_pemeriksa = Carbon::parse($date_pemeriksa);

        $day = Terbilang::make($date_pemeriksa->format('d'));
        $nama_bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $month = $nama_bulan[$date_pemeriksa->format('n')];
        $year = Terbilang::make($date_pemeriksa->format('Y'));

        $date_pemeriksa_text_day = ucwords($day);
        $date_pemeriksa_text_month = ucwords($month);
        $date_pemeriksa_text_year = ucwords($year);

        $data_pemeriksa = LPJTimPemeriksa::where('NIP', '=', $data_belanja->tim_pemeriksa)->get();
        $data_anggota_pemeriksa = $data_pemeriksa->first()->AnggotaLPJTimPemeriksa()->get();
        $html = view('lpj-belanja.generate-pdf', ['date_pemeriksa_text_day' => $date_pemeriksa_text_day, 'date_pemeriksa_text_month' => $date_pemeriksa_text_month, 'date_pemeriksa_text_year' => $date_pemeriksa_text_year, 'tanggalProperCase' => $tanggalProperCase, 'date_pemeriksa_hari' => $date_pemeriksa_hari, 'date_pemeriksa_format' => $date_pemeriksa_format, 'tahun' => $tahun_terbilang, 'date_pesanan' => $date_pesanan, 'hari' => $hari, 'data_anggota_pemeriksa' => $data_anggota_pemeriksa, 'data_pemeriksa' => $data_pemeriksa->first(), 'data' => $data, 'data_belanja' => $data_belanja, 'data_barang' => $data_barang])->render();


        // Adjust PDF options if needed
        $pdf = PDF::loadHtml($html)->setPaper('f4', 'portrait');

        return $pdf->stream('LPJBelanja.pdf');
    }
}
