<?php

namespace App\Http\Controllers;

use App\DataTables\LPJTimPemeriksaDataTable;
use App\Http\Requests\TimPemeriksaFormRequest;
use App\Models\LPJTimPemeriksa;
use App\Models\AnggotaLPJTimPemeriksa;
use Illuminate\Http\Request;

class LPJTimPemeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LPJTimPemeriksaDataTable $dataTable)
    {
        return $dataTable->render('lpj-timpemeriksa.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lpj-timpemeriksa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TimPemeriksaFormRequest $request)
    {
        $userId = auth()->user()->id;

        $data_ketua = [
            'NIP' => $request->NIP,
            'nama' => $request->nama_ketua,
            'jabatan' => $request->jabatan_ketua,
            'tgl_pemeriksa' => $request->tgl_pemeriksa,
            'nomor' => $request->nomor,
            'tahun' => $request->tahun,
            'alamat' => $request->alamat,
            'user_id' => $userId,
        ];

        // Create LPJTimPemeriksa
        $lpjTimPemeriksa = LPJTimPemeriksa::create($data_ketua);

        // Check if there are members to add
        if ($request->nama != null) {
            for ($i = 0; $i < sizeof($request->nama); $i++) {
                $data = [
                    'timpemeriksa_id' => $lpjTimPemeriksa->id,
                    'nama' => $request->nama[$i],
                    'jabatan' => $request->jabatan[$i],
                ];
                AnggotaLPJTimPemeriksa::create($data);
            }
        }
        return redirect()->route('lpj-timpemeriksa.index')->with('success', 'Data berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(LPJTimPemeriksa $lPJTimPemeriksa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data_ketua = LPJTimPemeriksa::find($id);
        $data_anggota = $data_ketua->AnggotaLPJTimPemeriksa;

        return view('lpj-timpemeriksa.edit', ['data_ketua' => $data_ketua, 'data_anggota' => $data_anggota]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userId = auth()->user()->id;

        $data = LPJTimPemeriksa::find($id);
        $data_ketua = [
            'NIP' => $request->NIP,
            'nama' => $request->nama_ketua,
            'jabatan' => $request->jabatan_ketua,
            'tgl_pemeriksa' => $request->tgl_pemeriksa,
            'nomor' => $request->nomor,
            'tahun' => $request->tahun,
            'alamat' => $request->alamat,
            'user_id' => $userId,
        ];

        // Update LPJTimPemeriksa
        $data->update($data_ketua);

        // Remove existing members
        $data->AnggotaLPJTimPemeriksa()->delete();

        // Add new members
        if ($request->nama != null) {
            for ($i = 0; $i < sizeof($request->nama); $i++) {
                $memberData = [
                    'timpemeriksa_id' => $id,
                    'nama' => $request->nama[$i],
                    'jabatan' => $request->jabatan[$i],
                ];
                AnggotaLPJTimPemeriksa::create($memberData);
            }
        }
        return redirect()->route('lpj-timpemeriksa.index')->with('success', 'Data berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = LPJTimPemeriksa::find($id);
        if ($user->AnggotaLPJTimPemeriksa()->exists()) {
            $user->AnggotaLPJTimPemeriksa()->delete();
        }
        $user->delete();
        return redirect()->route('lpj-timpemeriksa.index')->with('success', 'Data berhasil dihapus');
    }

    public function pdfTemplate(LPJTimPemeriksaDataTable $dataTable)
    {
        // Retrieve the data directly from the query builder
        $data = $dataTable->query(new LPJTimPemeriksa())->get();

        // Send data to the view for PDF rendering
        $html = view('lpj-timpemeriksa.generate-pdf', ['data' => $data])->render();

        // Adjust PDF options if needed
        $pdf = PDF::loadHtml($html)->setPaper('f4', 'landscape');

        return $pdf->stream('LPJTimPemeriksa.pdf');
    }
}
