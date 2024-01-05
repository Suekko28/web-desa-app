<?php

namespace App\Http\Controllers;

use App\DataTables\PemerintahanPosyanduDataTable;
use App\Http\Requests\PemerintahanPosyanduRequest;
use App\Models\PemerintahanPosyandu;
use Barryvdh\DomPDF\Facade\Pdf;



class PemerintahanPosyanduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PemerintahanPosyanduDataTable $dataTable)
    {
        return $dataTable->render('pemerintahan-posyandu.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemerintahan-posyandu.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PemerintahanPosyanduRequest $request)
    {
       
        $image=$request->file('profile');
        $nama_image=rand().$image->getClientOriginalName();
        $image->storeAs('public/posyandu', $nama_image);
        
        $data=$request->all();
        $data['profile']=$nama_image;
        
        PemerintahanPosyandu::create($data);
        return redirect()->route('pemerintahan-posyandu.index')->with('success','data berhasil ditambahkan');
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
        $user=PemerintahanPosyandu::find($id);
        return view('pemerintahan-posyandu.edit',[
                    "data"=>$user,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PemerintahanPosyanduRequest $request, string $id)
    {
        $user = PemerintahanPosyandu::find($id);
    
        // Check if a new image is uploaded
        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $extension = $image->getClientOriginalExtension(); // Get the file extension
            $nama_image = time() . '_' . uniqid() . '.' . $extension;
    
            // Move the uploaded file to the storage location
            $image->storeAs('public/posyandu', $nama_image);
    
            // Update the profile field with the new filename
            $user->update(['profile' => $nama_image]);
        }
    
        // Update other fields based on the request
        $user->update($request->except('profile'));
        return redirect()->route('pemerintahan-posyandu.index')->with('success','data berhasil diubah'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=PemerintahanPosyandu::find($id)->delete();
        return redirect()->route('pemerintahan-posyandu.index')->with('success','data berhasil dihapus'); 
    }

    public function pdfTemplate(PemerintahanPosyanduDataTable $dataTable)
    {
        // Retrieve the data directly from the query builder
        $data = $dataTable->query(new PemerintahanPosyandu())->get();
    
        // Send data to the view for PDF rendering
        $html = view('pemerintahan-posyandu.generate-pdf', ['data' => $data])->render();
    
        // Adjust PDF options if needed
        $pdf = PDF::loadHtml($html)->setPaper('f4', 'landscape');
        
        return $pdf->stream('PemerintahanPosyandu.pdf');
    }
}
