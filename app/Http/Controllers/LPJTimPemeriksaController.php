<?php

namespace App\Http\Controllers;

use App\DataTables\LPJTimPemeriksaDataTable;
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
    public function store(Request $request)
    {
        $data_ketua=[
            'NIP'=>$request->NIP,
            'nama'=>$request->nama_ketua,
            'jabatan'=>$request->jabatan_ketua,
            'tgl_pemeriksa'=>$request->tgl_pemeriksa,
            'nomor'=>$request->nomor,
            'tahun'=>$request->tahun,
            'alamat'=>$request->alamat,
        ];

        LPJTimPemeriksa::create($data_ketua);
        $id_ketua=LPJTimPemeriksa::where('NIP','=',$data_ketua['NIP'])->where('jabatan','=',$data_ketua['jabatan'])->where('tgl_pemeriksa','=',$data_ketua['tgl_pemeriksa'])->first();
        for($i=0;$i<sizeof($request->nama);$i++){
            $data=[
                'id_ketua'=>$id_ketua->id,
                'nama'=>$request->nama[$i],
                'jabatan'=>$request->jabatan[$i],
            ];
            AnggotaLPJTimPemeriksa::create($data);
        }

        return redirect()->route('lpj-timpemeriksa.index')->with('success','Data berhasil ditambahkan');
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
    public function edit(LPJTimPemeriksa $lPJTimPemeriksa,String $id)
    {
        
        $data_ketua=LPJTimPemeriksa::find($id)->first();
        $data_anggota=$data_ketua->AnggotaLPJTimPemeriksa;
        return view('lpj-timpemeriksa.edit',['data_ketua'=>$data_ketua,'data_anggota'=>$data_anggota]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $data=LPJTimPemeriksa::find($id);
        $data_ketua=[
            'NIP'=>$request->NIP,
            'nama'=>$request->nama_ketua,
            'jabatan'=>$request->jabatan_ketua,
            'tgl_pemeriksa'=>$request->tgl_pemeriksa,
            'nomor'=>$request->nomor,
            'tahun'=>$request->tahun,
            'alamat'=>$request->alamat,
        ];
        $data->update($data_ketua);
        $data->AnggotaLPJTimPemeriksa()->delete();
        for($i=0;$i<sizeof($request->nama);$i++){
            $data=[
                'id_ketua'=>$id,
                'nama'=>$request->nama[$i],
                'jabatan'=>$request->jabatan[$i],
            ];
            AnggotaLPJTimPemeriksa::create($data);
        }
        return redirect()->route('lpj-timpemeriksa.index')->with('success','Data berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
       $user=LPJTimPemeriksa::find($id)->delete();
       return redirect()->route('lpj-timpemeriksa.index')->with('success', 'Data berhasil dihapus');
    }

    public function destroy_child(String $id){

    }
}
