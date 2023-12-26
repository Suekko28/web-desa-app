<?php

namespace App\Http\Controllers;

use App\DataTables\PemerintahDesaDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\PemerintahanDesaFormRequest;
use App\Models\PemerintahanDesa;
use Barryvdh\DomPDF\Facade\Pdf;
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
        $image=$request->file('profile');
        $nama_image=rand().$image->getClientOriginalName();
        $image->storeAs('public/desa', $nama_image);
        
        $data=$request->all();
        $data['profile']=$nama_image;
        
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
        $user = PemerintahanDesa::find($id);
    
        // Check if a new image is uploaded
        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $extension = $image->getClientOriginalExtension(); // Get the file extension
            $nama_image = time() . '_' . uniqid() . '.' . $extension;
    
            // Move the uploaded file to the storage location
            $image->storeAs('public/desa', $nama_image);
    
            // Update the profile field with the new filename
            $user->update(['profile' => $nama_image]);
        }
    
        // Update other fields based on the request
        $user->update($request->except('profile'));
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

    public function cetak_pdf()
    {
        $items = PemerintahanDesa::all(); // or retrieve your data as needed
        $pdf = Pdf::loadView('pemerintahan-desa.pdf', ['items' => $items])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
