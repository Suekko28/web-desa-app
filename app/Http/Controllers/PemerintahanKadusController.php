<?php

namespace App\Http\Controllers;

use App\DataTables\PemerintahanKadusDataTable;
use App\Http\Requests\PemerintahanKadusRequest;
use App\Models\PemerintahanKadus;
use Illuminate\Http\Request;

class PemerintahanKadusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PemerintahanKadusDataTable $dataTable)
    {
        return $dataTable->render('pemerintahan-kadus.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemerintahan-kadus.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PemerintahanKadusRequest $request)
    {   
        $image=$request->file('profile');
        $nama_image=rand().$image->getClientOriginalName();
        $image->storeAs('public/kadus', $nama_image);
        
        $data=$request->all();
        $data['profile']=$nama_image;
        
        PemerintahanKadus::create($data);
        return redirect()->route('pemerintahan-kadus.index')->with('success','Data berhasil ditambahkan'); 

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
        $user=PemerintahanKadus::find($id);
        return view('pemerintahan-kadus.edit',[
                    "data"=>$user,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = PemerintahanKadus::find($id);
    
        // Check if a new image is uploaded
        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $extension = $image->getClientOriginalExtension(); // Get the file extension
            $nama_image = time() . '_' . uniqid() . '.' . $extension;
    
            // Move the uploaded file to the storage location
            $image->storeAs('public/kadus', $nama_image);
    
            // Update the profile field with the new filename
            $user->update(['profile' => $nama_image]);
        }
    
        // Update other fields based on the request
        $user->update($request->except('profile'));
    
        return redirect()->route('pemerintahan-kadus.index')->with('success', 'Data berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=PemerintahanKadus::find($id)->delete();
        return redirect()->route('pemerintahan-kadus.index')->with('success','Data berhasil dihapus'); 

    }
}
