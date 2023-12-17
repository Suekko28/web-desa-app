<?php

namespace App\Http\Controllers;

use App\DataTables\PemerintahanBPDDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\PemerintahanBPDFormRequest;
use App\Models\PemerintahanBPD;
use App\Models\Image;

use Illuminate\Http\Request;

class PemerintahanBPDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PemerintahanBPDDataTable $dataTable)
    {
        return $dataTable->render('pemerintahan-BPD.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemerintahan-BPD.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PemerintahanBPDFormRequest $request)
    {   
        $path = public_path('images/');
        !is_dir($path) &&
            mkdir($path, 0777, true);
        $imageName = time(). '_'.$request->nama . '.' . $request->profile->extension();
        $request->profile->move($path, $imageName);

        $data=$request->all();
        $data['profile']=$imageName;
        
        PemerintahanBPD::create($data);
        return redirect()->route('pemerintahan-BPD.index')->with('success','Data berhasil ditambahkan'); 

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=PemerintahanBPD::find($id);
        return view('pemerintahan-BPD.edit',[
                    "data"=>$user,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user=PemerintahanBPD::find($id)->update($request->all());
        return redirect()->route('pemerintahan-BPD.index')->with('success','Data berhasil diubah'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=PemerintahanBPD::find($id)->delete();
        return redirect()->route('pemerintahan-BPD.index')->with('success','Data berhasil dihapus'); 
    }
}
