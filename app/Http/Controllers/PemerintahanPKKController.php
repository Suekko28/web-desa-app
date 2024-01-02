<?php

namespace App\Http\Controllers;

use App\DataTables\PemerintahanPKKDataTable;
use App\Http\Requests\PemerintahanPKKRequest;
use App\Models\PemerintahanPKK;
use Barryvdh\DomPDF\Facade\Pdf;


class PemerintahanPKKController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PemerintahanPKKDataTable $dataTable)
    {
        return $dataTable->render('pemerintahan-pkk.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemerintahan-pkk.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PemerintahanPKKRequest $request)
    {
        $image=$request->file('profile');
        $nama_image=rand().$image->getClientOriginalName();
        $image->storeAs('public/pkk', $nama_image);
        
        $data=$request->all();
        $data['profile']=$nama_image;
        
        PemerintahanPKK::create($data);
        return redirect()->route('pemerintahan-pkk.index')->with('success','data berhasil ditambahkan');
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
        $user=PemerintahanPKK::find($id);
        return view('pemerintahan-pkk.edit',[
                    "data"=>$user,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PemerintahanPKKRequest $request, string $id)
    {
        $user = PemerintahanPKK::find($id);
    
        // Check if a new image is uploaded
        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $extension = $image->getClientOriginalExtension(); // Get the file extension
            $nama_image = time() . '_' . uniqid() . '.' . $extension;
    
            // Move the uploaded file to the storage location
            $image->storeAs('public/pkk', $nama_image);
    
            // Update the profile field with the new filename
            $user->update(['profile' => $nama_image]);
        }
    
        // Update other fields based on the request
        $user->update($request->except('profile'));
        return redirect()->route('pemerintahan-pkk.index')->with('success','data berhasil diubah'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=PemerintahanPKK::find($id)->delete();
        return redirect()->route('pemerintahan-pkk.index')->with('success','data berhasil dihapus'); 
    }

    public function pdfTemplate(PemerintahanPKKDataTable $dataTable)
    {
        // Retrieve the data directly from the query builder
        $data = $dataTable->query(new PemerintahanPKK())->get();
    
        // Send data to the view for PDF rendering
        $html = view('pemerintahan-pkk.generate-pdf', ['data' => $data])->render();
    
        // Adjust PDF options if needed
        $pdf = PDF::loadHtml($html)->setPaper('f4', 'landscape');
        
        return $pdf->stream('PemerintahanPKK.pdf');
    }
}
