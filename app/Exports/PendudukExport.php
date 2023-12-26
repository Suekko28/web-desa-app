<?php

namespace App\Exports;

use App\DataTables\Scopes\PendudukScope;
use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PendudukExport implements FromQuery, withHeadings, withMapping
{
    use Exportable;
    protected $request;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function __construct($request)
    {
        $this->request = $request;
    }
    
    public function query()
    {
        $query = Penduduk::query()->select(
            "penduduk.id",
            "penduduk.tgl_pindah_masuk",
            "penduduk.tgl_lapor",
            "penduduk.NIK",
            "penduduk.NKK",
            "penduduk.nama",
            "penduduk.tempat_lahir",
            "penduduk.tgl_lahir",
            "penduduk.usia",
            "penduduk.jenis_kelamin",
            "penduduk.status_pernikahan",
            "penduduk.agama",
            "penduduk.kewarganegaraan",
            "penduduk.dusun",
            "penduduk.rt",
            "penduduk.rw",
            "penduduk.alamat",
            "penduduk.pendidikan",
            "penduduk.pekerjaan",
            "penduduk.kepemilikan_bpjs",
            "penduduk.kepemilikan_e_ktp",
            "penduduk.nama_ibu",
            "penduduk.nama_ayah"
        );
        $filters =  [
            'pendidikan',
            'pekerjaan',
            'kepemilikan_bpjs',
            'kepemilikan_e_ktp',
            'jenis_kelamin',
            'status_pernikahan',
            'agama',
            'rt',
            'rw',
            
        ];
        foreach ($filters as $field) {
            if ($this->request->has($field)) {
                if($this->request->get($field) !== null){
                    $query->where($field, '=', $this->request->get($field));
                }
            }
        }
        $mn='0';
        $mx='999';
        if($this->request->has('usia_mn')){
            if($this->request->get('usia_mn')!=null){
            $mn=$this->request->get('usia_mn');
                if((int)$mn<0){
                    $mn='0';
                }
            }
            $query->where('usia', '>=', $mn);
        }

        if($this->request->has('usia_mx')){
            if($this->request->get('usia_mx')!=null and $this->request->get('usia_mx')!="?draw=1"){
            $mx=$this->request->get('usia_mx');
                if((int)$mx>999){
                    $mx='999';
                }
            }
            $query->where('usia', '<=', $mx);
        }
        

        // order
        $order_column = [
            "penduduk.id",
            "penduduk.tgl_pindah_masuk",
            "penduduk.tgl_lapor",
            "penduduk.NIK",
            "penduduk.NKK",
            "penduduk.nama",
            "penduduk.tempat_lahir",
            "penduduk.tgl_lahir",
            "penduduk.usia",
            "penduduk.jenis_kelamin",
            "penduduk.status_pernikahan",
            "penduduk.agama",
            "penduduk.kewarganegaraan",
            "penduduk.dusun",
            "penduduk.rt",
            "penduduk.rw",
            "penduduk.alamat",
            "penduduk.pendidikan",
            "penduduk.pekerjaan",
            "penduduk.kepemilikan_bpjs",
            "penduduk.kepemilikan_e_ktp",
            "penduduk.nama_ibu",
            "penduduk.nama_ayah"
        ];

        
        return $query;
    }

    public function headings(): array
    {
        return [
            "id",
            "tgl_pindah_masuk",
            "tgl_lapor",
            "NIK",
            "NKK",
            "nama",
            "tempat_lahir",
            "tgl_lahir",
            "usia",
            "jenis_kelamin",
            "status_pernikahan",
            "agama",
            "kewarganegaraan",
            "dusun",
            "rt",
            "rw",
            "alamat",
            "pendidikan",
            "pekerjaan",
            "kepemilikan_bpjs",
            "kepemilikan_e_ktp",
            "nama_ibu",
            "nama_ayah"
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->tgl_pindah_masuk,
            $row->tgl_lapor,
            $row->NIK,
            $row->NKK,
            $row->nama,
            $row->tempat_lahir,
            $row->tgl_lahir,
            $row->usia,
            $row->jenis_kelamin,
            $row->agama,
            $row->kewarganegaraan,
            $row->status_pernikahan,
            $row->dusun,
            $row->rt,
            $row->rw,
            $row->alamat,
            $row->pekerjaan,
            $row->kepemilikan_bpjs,
            $row->kepemilikan_e_ktp,
            $row->nama_ibu,
            $row->nama_ayah,
        ];
    }
}
