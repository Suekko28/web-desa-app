<?php

namespace App\Http\Controllers;

use App\DataTables\PemerintahDesaDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\PemerintahanDesaFormRequest;
use App\Http\Requests\PendudukFormRequest;
use App\Models\PemerintahanDesa;
use Illuminate\Http\Request;

class PemerintahanDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PemerintahDesaDataTable $dataTable)
    {
        return $dataTable->render('pemerintahan-desa.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemerintahan-desa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PemerintahanDesaFormRequest $request)
    {
        $path = public_path('images/');
        !is_dir($path) &&
            mkdir($path, 0777, true);
        $imageName = time(). '_'.$request->nama . '.' . $request->profile->extension();
        $request->profile->move($path, $imageName);

        $data=$request->all();
        $data['profile']=$imageName;
        
        PemerintahanDesa::create($data);
        return redirect()->route('pemerintahan-desa.index')->with('success','data berhasil ditambahkan'); 
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
        $user=PemerintahanDesa::find($id);
        return view('pemerintahan-desa.edit',[
                    "data"=>$user,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PemerintahanDesaFormRequest $request, string $id)
    {
        $user=PemerintahanDesa::find($id)->update($request->all());
        return redirect()->route('pemerintahan-desa.index')->with('success','data berhasil diubah'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=PemerintahanDesa::find($id)->delete();
        return redirect()->route('pemerintahan-desa.index')->with('success','data berhasil dihapus'); 

    }
}
