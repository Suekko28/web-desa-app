<?php

namespace App\Imports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;

class PendudukImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {  
        if ($row[0]=='NO') {
            return null;
        }
  
        return new Penduduk([
            'tgl_pindah_masuk'=>date('Y-m-d'),
            'tgl_lapor'=>date('Y-m-d'),
            'NIK'=>$row[1],
            'NKK'=>$row[2],
            'nama'=>$row[3],
            'jenis_kelamin'=>$this->getKelamin(strtolower($row[4])),
            'tempat_lahir'=>$row[5],
            'tgl_lahir'=>$row[6],
            'agama'=>$row[7],
            'usia'=>$row[8],
            'status_pernikahan'=>$row[9],
            'alamat'=>$row[10],
            'kewarganegaraan'=>$row[11],
            'dusun'=>$row[12],
            'rt'=>$row[13],
            'rw'=>$row[14],
            'kepemilikan_bpjs'=>$row[15],
            'kepemilikan_e_ktp'=>$row[16],
            'pekerjaan'=>$row[17],
            'pendidikan'=>$row[18],
            'nama_ibu'=>$row[19],
            'nama_ayah'=>$row[20],
        ]);
    }

    private function getKelamin($data){
        return ($data === 'laki-laki') ? '1' : (($data === 'perempuan') ? '1' : null);
    }

   
}
