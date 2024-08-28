<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PendudukFormRequest;
use App\Models\Penduduk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendudukApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Menampilkan daftar semua data penduduk.
     */
    public function index()
    {
        // Mengambil semua data penduduk dari database dan mengurutkannya berdasarkan ID secara menurun.
        $data = Penduduk::orderBy('id', 'desc')->get();

        // Mengembalikan respon JSON dengan status true, pesan, dan data penduduk.
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data,
        ], 200);

        // (Bagian ini tidak akan pernah dieksekusi karena kode di atas sudah mengembalikan respon)
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'message' => 'Data Tidak Ditemukan',
            ], 404);
        }
    }

    /**
     * Menyimpan data penduduk baru ke dalam database.
     */
    public function store(PendudukFormRequest $request)
    {
        // Memvalidasi data yang diterima dari request.
        $validatedData = $request->validated();

        // Membuat instance baru dari model Penduduk dan mengisi dengan data yang divalidasi.
        $dataPenduduk = new Penduduk();
        $dataPenduduk->fill($validatedData);

        // Menghitung usia berdasarkan tanggal lahir.
        $tglLahir = Carbon::parse($request->tgl_lahir);
        $usia = $tglLahir->diffInYears(Carbon::now());

        // Mengisi field usia dengan nilai yang dihitung.
        $dataPenduduk['usia'] = $usia;

        // Menyimpan data penduduk ke dalam database.
        $dataPenduduk->save();

        // Mengembalikan respon sukses dengan status true dan data penduduk yang baru disimpan.
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil disimpan',
            'data' => $dataPenduduk,
        ], 201);
    }

    /**
     * Menampilkan data penduduk berdasarkan ID yang diberikan.
     */
    public function show(string $id)
    {
        // Mencari data penduduk berdasarkan ID.
        $data = Penduduk::find($id);

        // Jika data ditemukan, mengembalikan respon JSON dengan status true dan data.
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data,
            ], 200);
        } else {
            // Jika data tidak ditemukan, mengembalikan respon dengan status false.
            return response()->json([
                'status' => false,
                'message' => "Data tidak ditemukan"
            ], 404);
        }
    }

    /**
     * Menampilkan data penduduk yang ingin diedit berdasarkan ID.
     */
    public function edit(string $id)
    {
        // Mencari data penduduk berdasarkan ID.
        $dataPenduduk = Penduduk::find($id);

        // Jika data tidak ditemukan, mengembalikan respon dengan status false.
        if (!$dataPenduduk) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        // Jika data ditemukan, mengembalikan data tersebut dalam bentuk JSON untuk proses edit.
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $dataPenduduk,
        ], 200);
    }

    /**
     * Memperbarui data penduduk yang ada di database berdasarkan ID.
     */
    public function update(PendudukFormRequest $request, string $id)
    {
        // Mencari data penduduk berdasarkan ID.
        $dataPenduduk = Penduduk::find($id);

        // Jika data tidak ditemukan, mengembalikan respon dengan status false.
        if (!$dataPenduduk) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        // Memvalidasi data yang diterima dari request.
        $validatedData = $request->validated();

        // Mengisi data penduduk dengan data yang divalidasi.
        $dataPenduduk->fill($validatedData);

        // Jika tanggal lahir diubah, hitung ulang usia.
        if (isset($validatedData['tgl_lahir'])) {
            $tglLahir = Carbon::parse($validatedData['tgl_lahir']);
            $usia = $tglLahir->diffInYears(Carbon::now());
            $dataPenduduk['usia'] = $usia;
        }

        // Menyimpan perubahan data penduduk ke dalam database.
        $dataPenduduk->save();

        // Mengembalikan respon sukses dengan status true dan data yang diperbarui.
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diperbarui',
            'data' => $dataPenduduk,
        ], 200);
    }

    /**
     * Menghapus data penduduk dari database berdasarkan ID.
     */
    public function destroy(string $id)
    {
        // Mencari data penduduk berdasarkan ID.
        $data = Penduduk::find($id);

        // Jika data tidak ditemukan, mengembalikan respon dengan status false.
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'message' => 'Data Tidak Ditemukan',
            ], 404);
        }

        // Menghapus data dari database.
        $data->delete();

        // Mengembalikan respon sukses dengan status true setelah data berhasil dihapus.
        return response()->json([
            'status' => true,
            'message' => 'Berhasil delete data',
        ], 200);
    }
}

