<?php

namespace App\Http\Controllers;

use App\DataTables\PemerintahanLPMDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\PemerintahanLPMRequest;
use App\Models\PemerintahanLPM;

class PemerintahanLPMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PemerintahanLPMDataTable $dataTable)
    {
        return $dataTable->render('pemerintahan-lpm.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemerintahan-lpm.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PemerintahanLPMRequest $request)
    {
        $path = public_path('images/');
        !is_dir($path) &&
            mkdir($path, 0777, true);
        $imageName = time(). '_'.$request->nama . '.' . $request->profile->extension();
        $request->profile->move($path, $imageName);

        $data=$request->all();
        $data['profile']=$imageName;
        
        PemerintahanLPM::create($data);
        return redirect()->route('pemerintahan-lpm.index')->with('success','data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $user=PemerintahanLPM::find($id);
        return view('pemerintahan-lpm.edit',[
                    "data"=>$user,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PemerintahanLPMRequest $request, string $id)
    {
        $user=PemerintahanLPM::find($id)->update($request->all());
        return redirect()->route('pemerintahan-lpm.index')->with('success','data berhasil diubah'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=PemerintahanLPM::find($id)->delete();
        return redirect()->route('pemerintahan-lpm.index')->with('success','data berhasil dihapus'); 
    }
}
