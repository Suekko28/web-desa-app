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
        $image=$request->file('profile');
        $nama_image=rand().$image->getClientOriginalName();
        $image->storeAs('public/lpm', $nama_image);
        
        $data=$request->all();
        $data['profile']=$nama_image;
        
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
        $user = PemerintahanLPM::find($id);
    
        // Check if a new image is uploaded
        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $extension = $image->getClientOriginalExtension(); // Get the file extension
            $nama_image = time() . '_' . uniqid() . '.' . $extension;
    
            // Move the uploaded file to the storage location
            $image->storeAs('public/lpm', $nama_image);
    
            // Update the profile field with the new filename
            $user->update(['profile' => $nama_image]);
        }
    
        // Update other fields based on the request
        $user->update($request->except('profile'));
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
