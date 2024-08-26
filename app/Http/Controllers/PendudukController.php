<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Exports\PendudukExport;
use App\DataTables\Scopes\PendudukScope;
use App\DataTables\PendudukDataTable;
use App\DataTables\PendudukFullDataTable;
use App\Http\Controllers\Controllers;
use App\Http\Requests\PemerintahanDesaFormRequest;
use App\Models\Penduduk;
use App\Models\Anak;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\PendudukFormRequest;
use App\Imports\PendudukImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PendudukDataTable $dataTable, Request $request)
    {
        // dd($request);

        if ($dataTable->request()->action == 'pdf') {

            return redirect()->route('penduduk.generate-pdf', [$request]);
        }

        if ($dataTable->request()->action != null) {
            return Excel::download(new PendudukExport($request), 'penduduk-' . date('Y-m-d H:i:s') . ($dataTable->request()->action == 'excel' ? '.xlsx' : '.csv'));
        }
        return $dataTable->addScope(new PendudukScope($request))->render('penduduk.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penduduk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PendudukFormRequest $request)
    {

        $data = $request->all();

        $tglLahir = Carbon::parse($request->tgl_lahir);
        $usia = $tglLahir->diffInYears(Carbon::now());
        $userId = auth()->user()->id;

        // Tambahkan usia ke dalam data
        $data['usia'] = $usia;
        $data['user_id'] = $userId;

        Penduduk::create($data);

        return redirect()->route('penduduk.index')->with('success', 'Data berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Penduduk::find($id);

        return view('penduduk.view', [
            "data" => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Penduduk::find($id);
        return view('penduduk.edit', [
            "data" => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PendudukFormRequest $request, string $id)
    {
        // Ambil id pengguna yang sedang login
        $userId = auth()->user()->id;

        // Update data dengan memasukkan user_id
        $data = $request->all();
        $data['user_id'] = $userId;

        // Lakukan update pada data dengan id tertentu
        Penduduk::find($id)->update($data);

        return redirect()->route('penduduk.index')->with('success', 'Data berhasil diubah');
    }


    public function importPendudukView(Request $request)
    {
        return view('penduduk.import-view');
    }

    public function importPenduduk(Request $request)
    {


        $nama_file = rand() . $request->file_import->getClientOriginalName();
        $request->file_import->move('file_penduduk', $nama_file);
        $userId = auth()->user()->id;
        Excel::import(new PendudukImport($userId), public_path("/file_penduduk/" . $nama_file));
        File::delete(public_path("/file_penduduk/" . $nama_file));
        return redirect()->route('penduduk.index')->with('success', 'Data Berhasil Di Import');
    }


    public function destroy(string $id)
    {
        $user = Penduduk::find($id)->delete();
        return redirect()->route('penduduk.index')->with('success', 'Data berhasil dihapus');

    }
}
