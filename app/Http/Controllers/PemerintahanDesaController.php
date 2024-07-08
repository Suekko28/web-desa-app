<?php

namespace App\Http\Controllers;

use App\DataTables\PemerintahDesaDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\PemerintahanDesaFormRequest;
use App\Models\PemerintahanDesa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class PemerintahanDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PemerintahDesaDataTable $dataTable, Request $request)
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
        $image = $request->file('profile');
        $nama_image = rand() . $image->getClientOriginalName();
        $image->storeAs('public/desa', $nama_image);
        $userId = auth()->user()->id;


        $data = $request->all();
        $data['profile'] = $nama_image;
        $data['user_id'] = $userId;


        PemerintahanDesa::create($data);
        return redirect()->route('pemerintahan-desa.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = PemerintahanDesa::find($id);

        return view('pemerintahan-desa.view', [
            "data" => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = PemerintahanDesa::find($id);
        return view('pemerintahan-desa.edit', [
            "data" => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PemerintahanDesaFormRequest $request, string $id)
    {
        $user = PemerintahanDesa::find($id);
        $userId = auth()->user()->id;

        // Check if a new image is uploaded
        if ($request->hasFile('profile')) {
            // Delete the old image if it exists
            if ($user->profile) {
                Storage::delete('public/desa/' . $user->profile);
            }

            $image = $request->file('profile');
            $extension = $image->getClientOriginalExtension(); // Get the file extension
            $nama_image = time() . '_' . uniqid() . '.' . $extension;

            // Move the uploaded file to the storage location
            $image->storeAs('public/desa', $nama_image);

            // Update the profile field with the new filename
            $user->update(['profile' => $nama_image]);
        }

        // Update other fields based on the request, including the user ID
        $data = $request->except('profile');
        $data['user_id'] = $userId; // Add user ID to the data

        $user->update($data);

        return redirect()->route('pemerintahan-desa.index')->with('success', 'Data berhasil diubah');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = PemerintahanDesa::find($id)->delete();
        return redirect()->route('pemerintahan-desa.index')->with('success', 'Data berhasil dihapus');

    }

    public function pdfTemplate(PemerintahDesaDataTable $dataTable)
    {
        // Retrieve the data directly from the query builder
        $data = $dataTable->query(new PemerintahanDesa())->get();

        // Send data to the view for PDF rendering
        $html = view('pemerintahan-desa.generate-pdf', ['data' => $data])->render();

        // Adjust PDF options including setting paper to landscape
        $pdf = PDF::loadHtml($html)->setPaper('f4', 'landscape');

        return $pdf->stream('PemerintahanDesa.pdf');
    }


}
