<?php

namespace App\Http\Controllers;

use App\Http\Requests\PendudukFormRequest;
use App\Models\penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PendudukApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penduduk = Penduduk::all();
        return response()->json($penduduk, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PendudukFormRequest $request)
    {
        $data = $request->validated();

        $tglLahir = Carbon::parse($request->tgl_lahir);
        $usia = $tglLahir->diffInYears(Carbon::now());
        $userId = Auth::id();

        $data['usia'] = $usia;
        $data['user_id'] = $userId;

        $penduduk = Penduduk::create($data);

        return response()->json($penduduk, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $penduduk = Penduduk::find($id);

        if (!$penduduk) {
            return response()->json(['error' => 'Penduduk not found'], 404);
        }

        return response()->json($penduduk, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PendudukFormRequest $request, $id)
    {
        $penduduk = penduduk::find($id);

        if (!$penduduk) {
            return response()->json(['error' => 'Penduduk not found'], 404);
        }

        $data = $request->validated();
        $userId = Auth::id();
        $data['user_id'] = $userId;

        $penduduk->update($data);

        return response()->json($penduduk, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penduduk = Penduduk::find($id);

        if (!$penduduk) {
            return response()->json(['error' => 'Penduduk not found'], 404);
        }

        $penduduk->delete();

        return response()->json(['success' => 'Data berhasil dihapus'], 200);
    }
}
