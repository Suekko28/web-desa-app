<?php

namespace App\Http\Controllers;

use App\DataTables\PemerintahanPosyanduDataTable;
use App\Http\Requests\PemerintahanPosyanduRequest;
use App\Models\PemerintahanPosyandu;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;



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

        $image = $request->file('profile');
        $nama_image = rand() . $image->getClientOriginalName();
        $image->storeAs('public/posyandu', $nama_image);
        $userId = auth()->user()->id;


        $data = $request->all();
        $data['profile'] = $nama_image;
        $data['user_id'] = $userId;

        PemerintahanPosyandu::create($data);
        return redirect()->route('pemerintahan-posyandu.index')->with('success', 'data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = PemerintahanPosyandu::find($id);

        return view('pemerintahan-posyandu.view', [
            "data" => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = PemerintahanPosyandu::find($id);
        return view('pemerintahan-posyandu.edit', [
            "data" => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PemerintahanPosyanduRequest $request, string $id)
    {
        $user = PemerintahanPosyandu::find($id);
        $userId = auth()->user()->id;

        // Check if a new image is uploaded
        if ($request->hasFile('profile')) {
            // Delete the old image if it exists
            if ($user->profile) {
                Storage::delete('public/posyandu/' . $user->profile);
            }

            $image = $request->file('profile');
            $extension = $image->getClientOriginalExtension(); // Get the file extension
            $nama_image = time() . '_' . uniqid() . '.' . $extension;

            // Move the uploaded file to the storage location
            $image->storeAs('public/posyandu', $nama_image);

            // Update the profile field with the new filename
            $user->update(['profile' => $nama_image]);
        }

        // Update other fields based on the request, including the user ID
        $data = $request->except('profile');
        $data['user_id'] = $userId; // Add user ID to the data

        $user->update($data);
        return redirect()->route('pemerintahan-posyandu.index')->with('success', 'data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = PemerintahanPosyandu::find($id)->delete();
        return redirect()->route('pemerintahan-posyandu.index')->with('success', 'data berhasil dihapus');
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
