<?php

namespace App\Http\Controllers;

use App\DataTables\PemerintahanRWDataTable;
use App\Http\Requests\PemerintahanRWRequest;
use App\Models\PemerintahanRW;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class PemerintahanRWController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PemerintahanRWDataTable $dataTable)
    {
        return $dataTable->render('pemerintahan-rw.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemerintahan-rw.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PemerintahanRWRequest $request)
    {   
        $image=$request->file('profile');
        $nama_image=rand().$image->getClientOriginalName();
        $image->storeAs('public/rw', $nama_image);
        
        $data=$request->all();
        $data['profile']=$nama_image;
        
        PemerintahanRW::create($data);
        return redirect()->route('pemerintahan-rw.index')->with('success','Data berhasil ditambahkan'); 

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
        $user=PemerintahanRW::find($id);
        return view('pemerintahan-rt.edit',[
                    "data"=>$user,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = PemerintahanRW::find($id);
    
        // Check if a new image is uploaded
        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $extension = $image->getClientOriginalExtension(); // Get the file extension
            $nama_image = time() . '_' . uniqid() . '.' . $extension;
    
            // Move the uploaded file to the storage location
            $image->storeAs('public/rw', $nama_image);
    
            // Update the profile field with the new filename
            $user->update(['profile' => $nama_image]);
        }
    
        // Update other fields based on the request
        $user->update($request->except('profile'));
    
        return redirect()->route('pemerintahan-rw.index')->with('success', 'Data berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $user=PemerintahanRW::find($id)->delete();
        return redirect()->route('pemerintahan-rt.index')->with('success','Data berhasil dihapus'); 

    }
    
    public function pdfTemplate(PemerintahanRWDataTable $dataTable)
    {
        // Retrieve the data directly from the query builder
        $data = $dataTable->query(new PemerintahanRW())->get();
    
        // Send data to the view for PDF rendering
        $html = view('pemerintahan-rw.generate-pdf', ['data' => $data])->render();
    
        // Adjust PDF options if needed
        $pdf = PDF::loadHtml($html)->setPaper('a4', 'landscape');
        
        return $pdf->stream('PemerintahanRW.pdf');
    }
}
