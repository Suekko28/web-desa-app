<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PendudukFormRequest;
use App\Models\penduduk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendudukApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = penduduk::orderBy('id', 'desc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PendudukFormRequest $request)
    {
        // Validasi data
        $validatedData = $request->validated();

        // Menghitung usia berdasarkan tanggal lahir
        $tglLahir = Carbon::parse($request->tgl_lahir);
        $usia = $tglLahir->diffInYears(Carbon::now());

        // Mendapatkan user ID
        $userId = Auth::id();

        // Menambahkan usia dan user_id ke data yang sudah divalidasi
        $validatedData['usia'] = $usia;
        $validatedData['user_id'] = $userId;

        // Membuat instance baru dari model Penduduk dan mengisi dengan data yang sudah divalidasi
        $penduduk = new Penduduk($validatedData);

        // Menyimpan data
        $penduduk->save();

        // Mengembalikan respons JSON
        return response()->json([
            'status' => true,
            'message' => 'Sukses memasukkan data'
        ], 200);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = penduduk::findOrFail($id);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Data tidak ditemukan"
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Penduduk::find($id);
        
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'message' => 'Data Tidak Ditemukan',
            ], 404);
        }
        
        $data->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Berhasil delete data',
        ], 200);
    }
}
