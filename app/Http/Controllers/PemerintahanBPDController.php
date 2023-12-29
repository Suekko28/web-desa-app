<?php

namespace App\Http\Controllers;

use App\DataTables\PemerintahanBPDDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\PemerintahanBPDFormRequest;
use App\Models\PemerintahanBPD;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
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
        $image = $request->file('profile');
        $nama_image = rand() . $image->getClientOriginalName();
        $image->storeAs('public/bpd', $nama_image);

        $data = $request->all();
        $data['profile'] = $nama_image;

        PemerintahanBPD::create($data);
        return redirect()->route('pemerintahan-BPD.index')->with('success', 'Data berhasil ditambahkan');

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

        $user = PemerintahanBPD::find($id);
        return view('pemerintahan-BPD.edit', [
            "data" => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = PemerintahanBPD::find($id);

        // Check if a new image is uploaded
        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $extension = $image->getClientOriginalExtension(); // Get the file extension
            $nama_image = time() . '_' . uniqid() . '.' . $extension;

            // Move the uploaded file to the storage location
            $image->storeAs('public/bpd', $nama_image);

            // Update the profile field with the new filename
            $user->update(['profile' => $nama_image]);
        }

        // Update other fields based on the request
        $user->update($request->except('profile'));

        return redirect()->route('pemerintahan-BPD.index')->with('success', 'Data berhasil diubah');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = PemerintahanBPD::find($id)->delete();
        return redirect()->route('pemerintahan-BPD.index')->with('success', 'Data berhasil dihapus');
    }

    public function pdfTemplate(PemerintahanBPDDataTable $dataTable)
    {
        // Retrieve the data directly from the query builder
        $data = $dataTable->query(new PemerintahanBPD())->get();
    
        // Send data to the view for PDF rendering
        $html = view('pemerintahan-bpd.generate-pdf', ['data' => $data])->render();
    
        // Adjust PDF options if needed
        $pdf = PDF::loadHtml($html)->setPaper('a4', 'landscape');
        
        return $pdf->stream('PemerintahanBPD.pdf');
    }
    


}
