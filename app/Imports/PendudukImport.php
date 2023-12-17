<?php

namespace App\Imports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\ToModel;

class PendudukImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {  
        // dd($row);
        return new Penduduk([
            'tgl_pindah_masuk'=>$row[1],
            'tgl_lapor'=>$row[2],
            'NIK'=>$row[3],
            'NKK'=>$row[4],
            'nama'=>$row[5],
            'tempat_lahir'=>$row[6],
            'tgl_lahir'=>$row[7],
            'jenis_kelamin'=>$row[8],
            'agama'=>$row[9],
            'kewarganegaraan'=>$row[10],
            'status_pernikahan'=>$row[11],
            'dusun'=>$row[12],
            'rt'=>$row[13],
            'rw'=>$row[14],
            'alamat'=>$row[15],
            'pendidikan'=>$row[16],
            'pekerjaan'=>$row[17],
            'kepemilikan_bpjs'=>$row[18],
            'kepemilikan_e_ktp'=>$row[19],
            'nama_ibu'=>$row[20],
            'nama_ayah'=>$row[21],
        ]);
    }
}
