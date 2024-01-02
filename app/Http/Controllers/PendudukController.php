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
use App\Http\Controllers\PendudukController;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PendudukDataTable $dataTable,Request $request)
    {
        // dd($request);

        if($dataTable->request()->action =='pdf'){

            return redirect()->route('penduduk.generate-pdf',[$request]);
        }

        if($dataTable->request()->action != null){
            return Excel::download(new PendudukExport($request), 'penduduk-'. date('Y-m-d H:i:s') . ($dataTable->request()->action == 'excel' ? '.xlsx' : '.csv' ));
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
        
        $data=$request->all();

        $tglLahir = Carbon::parse($request->tgl_lahir);
        $usia = $tglLahir->diffInYears(Carbon::now());
    
        // Tambahkan usia ke dalam data
        $data['usia'] = $usia;
        
        Penduduk::create($data);
        
        return redirect()->route('penduduk.index')->with('success','data berhasil ditambahkan');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
     $data=Penduduk::find($id);
     
     return view('penduduk.view',[
        "data"=>$data,
     ]);  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $data=Penduduk::find($id);
        return view('penduduk.edit',[
                    "data"=>$data,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user=Penduduk::find($id)->update($request->all());
        return redirect()->route('penduduk.index')->with('success','data berhasil diubah'); 
    
    }

    public function importPendudukView(Request $request){
        return view('penduduk.import-view');
    }

    public function importPenduduk(Request $request){
        

        $nama_file = rand().$request->file_import->getClientOriginalName();
        $request->file_import->move('file_penduduk',$nama_file);
        Excel::import(new PendudukImport, public_path("/file_penduduk/".$nama_file));
        File::delete(public_path("/file_penduduk/".$nama_file));
        return redirect()->route('penduduk.index')->with('success', 'User Imported Successfully');
    }

    public function pdfTemplate(PendudukFullDataTable $dataTable,Request $request)
    {
        // Retrieve the data directly from the query builder
        // return $dataTable->addScope(new PendudukScope($request))->render('penduduk.index');
        // $data = $dataTable->query(new Anak())->get();
        $data = $dataTable->query(new Penduduk())->get();

        // $data->where('NIK','=','3201035403890005');
        // dd($data);
        // Send data to the view for PDF rendering
        $html = view('penduduk.generate-pdf', ['data' => $data])->render();
   
        // Adjust PDF options including setting paper to landscape
        $pdf = PDF::loadHtml($html)->setPaper('a4', 'landscape');
    
        return $pdf->stream('Penduduk.pdf');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            $user=Penduduk::find($id)->delete();
            return redirect()->route('penduduk.index')->with('success','data berhasil dihapus'); 

    }
}
