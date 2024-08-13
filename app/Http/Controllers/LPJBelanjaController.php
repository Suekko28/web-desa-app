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
    public function create($BarangJasaId)
    {
        $barangjasa_id = LPJBarangJasa::findOrFail($BarangJasaId);

        return view('lpj-belanja.create', [
            'barangjasa_id' => $barangjasa_id,
            'BarangJasaId' => $BarangJasaId,
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
            'barangjasa_id' => 'required',
        ], [
            'nama_barang.required' => 'Nama Barang wajib diisi.',
            'volume_qty.required' => 'Volume Quantity wajib diisi.',
            'satuan.required' => 'Satuan wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
            'barangjasa_id.required' => 'Barang jasa ID diisi.',
        ]);

        // Ambil ID pengguna yang sedang login
        $userId = auth()->user()->id;

        // Tambahkan user_id ke dalam data yang akan disimpan
        $validatedData['user_id'] = $userId;

        // Simpan data LPJBelanja berdasarkan data yang sudah divalidasi
        LPJBelanja::create($validatedData);

        // Redirect kembali ke halaman show lpj-belanja dengan id yang sesuai dan pesan sukses
        return redirect()->route('lpj-belanja.show', ['lpj_belanja' => $request->barangjasa_id])->with('success', 'Data berhasil ditambahkan');
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
    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $barangjasa_id, string $id)
    {
        // Temukan data LPJBelanja berdasarkan ID
        $data = LPJBelanja::findOrFail($id);

        // Temukan data LPJBarangJasa untuk form
        $barangjasa = LPJBarangJasa::findOrFail($barangjasa_id);

        // Kembalikan view edit dengan data yang diperlukan
        return view('lpj-belanja.edit', [
            'data' => $data,
            'barangjasa' => $barangjasa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $barangjasa_id, string $id)
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

        // Temukan data LPJBelanja berdasarkan ID dan perbarui
        $lpjBelanja = LPJBelanja::findOrFail($id);
        $lpjBelanja->update($validatedData);

        // Redirect kembali ke halaman show lpj-belanja dengan barangjasa_id yang sesuai dan pesan sukses
        return redirect()->route('lpj-belanja.show', ['lpj_belanja' => $barangjasa_id])->with('success', 'Berhasil mengubah data');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $barangjasa_id, string $id)
    {
        // Find the LPJBelanja record by ID
        $lpjBelanja = LPJBelanja::find($id);

        // Check if the record exists
        if ($lpjBelanja) {
            // Delete the record if it exists
            $lpjBelanja->delete();
            return redirect()->route('lpj-belanja.show', ['lpj_belanja' => $barangjasa_id])->with('success', 'Berhasil menghapus data');
        }

        // If the record doesn't exist, return a success message anyway
        return redirect()->route('lpj-belanja.show', ['lpj_belanja' => $barangjasa_id])->with('success', 'Data tidak ditemukan atau sudah dihapus');
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

        // Ensure that $data_belanja exists
        if (!$data_belanja) {
            return redirect()->route('lpj-belanja.show', ['lpj_belanja' => $id])->with('delete', "Data tidak ditemukan");
        }

        $data_barang = $data_belanja->LPJBelanja()->get();
        if (sizeof($data_barang) == 0) {
            return redirect()->route('lpj-belanja.show', ['lpj_belanja' => $id])->with('delete', "Tidak ada data belanja untuk barang/jasa ini");
        }



        $date_pesanan = $data_belanja->tgl_pesanan;
        $date_pesanan = strtotime($date_pesanan);
        $tahun_terbilang = Terbilang::make(date('Y'));

        $bulan_pesanan_terbilang = Carbon::create()->month(date('m', $date_pesanan))->isoFormat('MMMM');
        $tahun_pesanan = Carbon::create()->year(date('Y', $date_pesanan))->isoFormat('Y');
        $date_pesanan = date('d', $date_pesanan) . ' ' . $bulan_pesanan_terbilang . ' ' . $tahun_pesanan;

        // Retrieve tim pemeriksa and anggota data from LPJBarangJasa relationship
        $data_pemeriksa = $data_belanja->timPemeriksa;


        $data_anggota_pemeriksa = $data_pemeriksa->anggotaLPJTimPemeriksa()->get();

        // Date Pada Hari ini
        $date_pemeriksa_formatted = $data_pemeriksa->tgl_pemeriksa;
        $date_pemeriksa_formatted = strtotime($date_pemeriksa_formatted);

        $bulan_pemeriksa_terbilang = Carbon::create()->month(date('m', $date_pemeriksa_formatted))->isoFormat('MMMM');
        $tahun_pemeriksa_formatted = Carbon::create()->year(date('Y', $date_pemeriksa_formatted))->isoFormat('Y');
        $date_pemeriksa_formatted = date('d', $date_pemeriksa_formatted) . ' ' . ucwords($bulan_pemeriksa_terbilang) . ' ' . $tahun_pemeriksa_formatted;

        $date_pemeriksa = $data_pemeriksa->tgl_pemeriksa;
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

        $html = view('lpj-belanja.generate-pdf', [
            'date_pemeriksa_text_day' => $date_pemeriksa_text_day,
            'date_pemeriksa_text_month' => $date_pemeriksa_text_month,
            'date_pemeriksa_text_year' => $date_pemeriksa_text_year,
            'tanggalProperCase' => $tanggalProperCase,
            'date_pemeriksa_hari' => $date_pemeriksa->isoFormat('dddd'),
            'date_pemeriksa' => $date_pemeriksa_formatted,
            'tahun' => $tahun_terbilang,
            'date_pesanan' => $date_pesanan,
            'hari' => $hari,
            'data_anggota_pemeriksa' => $data_anggota_pemeriksa,
            'data_pemeriksa' => $data_pemeriksa,
            'data' => $data,
            'data_belanja' => $data_belanja,
            'data_barang' => $data_barang
        ])->render();

        // Adjust PDF options if needed
        $pdf = PDF::loadHtml($html)->setPaper('f4', 'portrait');

        return $pdf->stream('LPJBelanja.pdf');
    }

}
