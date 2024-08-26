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
    public function index()
    {
        $data = Penduduk::orderBy('id', 'desc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data,
        ], 200);

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'message' => 'Data Tidak Ditemukan',
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PendudukFormRequest $request)
    {
        // Retrieve validated data
        $validatedData = $request->validated();

        // Create a new penduduk record and fill it with validated data
        $dataPenduduk = new Penduduk();
        $dataPenduduk->fill($validatedData);

        $tglLahir = Carbon::parse($request->tgl_lahir);
        $usia = $tglLahir->diffInYears(Carbon::now());

        $dataPenduduk['usia'] = $usia;

        // Save the penduduk record to the database
        $dataPenduduk->save();

        // Return a success response
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil disimpan',
            'data' => $dataPenduduk,
        ], 201);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Penduduk::find($id);
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
            ], 404);
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
