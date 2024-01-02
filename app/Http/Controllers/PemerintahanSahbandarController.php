<?php

namespace App\Http\Controllers;

use App\DataTables\PemerintahanSahbandarDataTable;
use App\Http\Requests\PemerintahanSahbandarRequest;
use App\Models\PemerintahanSahbandar;
use Barryvdh\DomPDF\Facade\Pdf;

class PemerintahanSahbandarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PemerintahanSahbandarDataTable $dataTable)
    {
        return $dataTable->render('pemerintahan-sahbandar.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemerintahan-sahbandar.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PemerintahanSahbandarRequest $request)
    {
       
        $image=$request->file('profile');
        $nama_image=rand().$image->getClientOriginalName();
        $image->storeAs('public/sahbandar', $nama_image);
        
        $data=$request->all();
        $data['profile']=$nama_image;
        
        PemerintahanSahbandar::create($data);
        return redirect()->route('pemerintahan-sahbandar.index')->with('success','data berhasil ditambahkan');
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
        $user=PemerintahanSahbandar::find($id);
        return view('pemerintahan-sahbandar.edit',[
                    "data"=>$user,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PemerintahanSahbandarRequest $request, string $id)
    {
        $user = PemerintahanSahbandar::find($id);
    
        // Check if a new image is uploaded
        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $extension = $image->getClientOriginalExtension(); // Get the file extension
            $nama_image = time() . '_' . uniqid() . '.' . $extension;
    
            // Move the uploaded file to the storage location
            $image->storeAs('public/sahbandar', $nama_image);
    
            // Update the profile field with the new filename
            $user->update(['profile' => $nama_image]);
        }
    
        return redirect()->route('pemerintahan-sahbandar.index')->with('success','data berhasil diubah'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=PemerintahanSahbandar::find($id)->delete();
        return redirect()->route('pemerintahan-sahbandar.index')->with('success','data berhasil dihapus'); 
    }

    public function pdfTemplate(PemerintahanSahbandarDataTable $dataTable)
    {
        // Retrieve the data directly from the query builder
        $data = $dataTable->query(new PemerintahanSahbandar())->get();
    
        // Send data to the view for PDF rendering
        $html = view('pemerintahan-sahbandar.generate-pdf', ['data' => $data])->render();
    
        // Adjust PDF options if needed
        $pdf = PDF::loadHtml($html)->setPaper('f4', 'landscape');
        
        return $pdf->stream('PemerintahanSahbandar.pdf');
    }
}
