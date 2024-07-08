<?php

namespace App\Http\Controllers;

use App\DataTables\PemerintahanRTDataTable;
use App\Http\Requests\PemerintahanRTRequest;
use App\Models\PemerintahanRT;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;


class PemerintahanRTController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PemerintahanRTDataTable $dataTable)
    {
        return $dataTable->render('pemerintahan-rt.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemerintahan-rt.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PemerintahanRTRequest $request)
    {
        $image = $request->file('profile');
        $nama_image = rand() . $image->getClientOriginalName();
        $image->storeAs('public/rt', $nama_image);
        $userId = auth()->user()->id;

        
        $data = $request->all();
        $data['profile'] = $nama_image;
        $data['user_id'] = $userId;


        PemerintahanRT::create($data);
        return redirect()->route('pemerintahan-rt.index')->with('success', 'Data berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = PemerintahanRT::find($id);

        return view('pemerintahan-rt.view', [
            "data" => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = PemerintahanRT::find($id);
        return view('pemerintahan-rt.edit', [
            "data" => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PemerintahanRTRequest $request, string $id)
    {
        $user = PemerintahanRT::find($id);
        $userId = auth()->user()->id;

        // Check if a new image is uploaded
        if ($request->hasFile('profile')) {
            // Delete the old image if it exists
            if ($user->profile) {
                Storage::delete('public/rt/' . $user->profile);
            }

            $image = $request->file('profile');
            $extension = $image->getClientOriginalExtension(); // Get the file extension
            $nama_image = time() . '_' . uniqid() . '.' . $extension;

            // Move the uploaded file to the storage location
            $image->storeAs('public/rt', $nama_image);

            // Update the profile field with the new filename
            $user->update(['profile' => $nama_image]);
        }

        // Update other fields based on the request, including the user ID
        $data = $request->except('profile');
        $data['user_id'] = $userId; // Add user ID to the data

        $user->update($data);

        return redirect()->route('pemerintahan-rt.index')->with('success', 'Data berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = PemerintahanRT::find($id)->delete();
        return redirect()->route('pemerintahan-rt.index')->with('success', 'Data berhasil dihapus');
    }

    public function pdfTemplate(PemerintahanRTDataTable $dataTable)
    {
        // Retrieve the data directly from the query builder
        $data = $dataTable->query(new PemerintahanRT())->get();

        // Send data to the view for PDF rendering
        $html = view('pemerintahan-rt.generate-pdf', ['data' => $data])->render();

        // Adjust PDF options if needed
        $pdf = PDF::loadHtml($html)->setPaper('f4', 'landscape');

        return $pdf->stream('PemerintahanRT.pdf');
    }

}
