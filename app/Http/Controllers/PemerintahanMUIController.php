<?php

namespace App\Http\Controllers;

use App\DataTables\PemerintahanMUIDataTable;
use App\Http\Requests\PemerintahanMUIRequest;
use App\Models\PemerintahanMUI;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;


class PemerintahanMUIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PemerintahanMUIDataTable $dataTable)
    {
        return $dataTable->render('pemerintahan-mui.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemerintahan-mui.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PemerintahanMUIRequest $request)
    {
        $image = $request->file('profile');
        $nama_image = rand() . $image->getClientOriginalName();
        $image->storeAs('public/mui', $nama_image);
        $userId = auth()->user()->id;


        $data = $request->all();
        $data['profile'] = $nama_image;
        $data['user_id'] = $userId;



        PemerintahanMUI::create($data);
        return redirect()->route('pemerintahan-mui.index')->with('success', 'data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = PemerintahanMUI::find($id);

        return view('pemerintahan-mui.view', [
            "data" => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = PemerintahanMUI::find($id);
        return view('pemerintahan-mui.edit', [
            "data" => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PemerintahanMUIRequest $request, string $id)
    {
        $user = PemerintahanMUI::find($id);
        $userId = auth()->user()->id;

        // Check if a new image is uploaded
        if ($request->hasFile('profile')) {
            // Delete the old image if it exists
            if ($user->profile) {
                Storage::delete('public/mui/' . $user->profile);
            }

            $image = $request->file('profile');
            $extension = $image->getClientOriginalExtension(); // Get the file extension
            $nama_image = time() . '_' . uniqid() . '.' . $extension;

            // Move the uploaded file to the storage location
            $image->storeAs('public/mui', $nama_image);

            // Update the profile field with the new filename
            $user->update(['profile' => $nama_image]);
        }

        // Update other fields based on the request, including the user ID
        $data = $request->except('profile');
        $data['user_id'] = $userId; // Add user ID to the data

        $user->update($data);

        return redirect()->route('pemerintahan-mui.index')->with('success', 'data berhasil diubah');
    }

    public function destroy(string $id)
    {
        $user = PemerintahanMUI::find($id)->delete();
        return redirect()->route('pemerintahan-mui.index')->with('success', 'Data berhasil dihapus');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function pdfTemplate(PemerintahanMUIDataTable $dataTable)
    {
        // Retrieve the data directly from the query builder
        $data = $dataTable->query(new PemerintahanMUI())->get();

        // Send data to the view for PDF rendering
        $html = view('pemerintahan-mui.generate-pdf', ['data' => $data])->render();

        // Adjust PDF options if needed
        $pdf = PDF::loadHtml($html)->setPaper('f4', 'landscape');

        return $pdf->stream('PemerintahanMUI.pdf');
    }
}
