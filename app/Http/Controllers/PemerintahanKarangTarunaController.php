<?php

namespace App\Http\Controllers;

use App\DataTables\PemerintahanKarangTarunaDataTable;
use App\Http\Requests\PemerintahanKarangTarunaRequest;
use App\Models\PemerintahanKarangTaruna;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;


class PemerintahanKarangTarunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PemerintahanKarangTarunaDataTable $dataTable)
    {
        return $dataTable->render('pemerintahan-karangtaruna.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemerintahan-karangtaruna.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PemerintahanKarangTarunaRequest $request)
    {
        $image = $request->file('profile');
        $nama_image = rand() . $image->getClientOriginalName();
        $image->storeAs('public/karangtaruna', $nama_image);
        $userId = auth()->user()->id;


        $data = $request->all();
        $data['profile'] = $nama_image;
        $data['user_id'] = $userId;



        PemerintahanKarangTaruna::create($data);
        return redirect()->route('pemerintahan-karang-taruna.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = PemerintahanKarangTaruna::find($id);

        return view('pemerintahan-karangtaruna.view', [
            "data" => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = PemerintahanKarangTaruna::find($id);
        return view('pemerintahan-karangtaruna.edit', [
            "data" => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PemerintahanKarangTarunaRequest $request, string $id)
    {
        $user = PemerintahanKarangTaruna::find($id);
        $userId = auth()->user()->id;

        // Check if a new image is uploaded
        if ($request->hasFile('profile')) {
            // Delete the old image if it exists
            if ($user->profile) {
                Storage::delete('public/karangtaruna/' . $user->profile);
            }

            $image = $request->file('profile');
            $extension = $image->getClientOriginalExtension(); // Get the file extension
            $nama_image = time() . '_' . uniqid() . '.' . $extension;

            // Move the uploaded file to the storage location
            $image->storeAs('public/karangtaruna', $nama_image);

            // Update the profile field with the new filename
            $user->update(['profile' => $nama_image]);
        }

        // Update other fields based on the request, including the user ID
        $data = $request->except('profile');
        $data['user_id'] = $userId; // Add user ID to the data

        $user->update($data);
        return redirect()->route('pemerintahan-karang-taruna.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = PemerintahanKarangTaruna::find($id)->delete();
        return redirect()->route('pemerintahan-karang-taruna.index')->with('success', 'Data berhasil dihapus');
    }

    public function pdfTemplate(PemerintahanKarangTarunaDataTable $dataTable)
    {
        // Retrieve the data directly from the query builder
        $data = $dataTable->query(new PemerintahanKarangTaruna())->get();

        // Send data to the view for PDF rendering
        $html = view('pemerintahan-karangtaruna.generate-pdf', ['data' => $data])->render();

        // Adjust PDF options if needed
        $pdf = PDF::loadHtml($html)->setPaper('f4', 'landscape');

        return $pdf->stream('PemerintahanKarangTaruna.pdf');
    }
}

