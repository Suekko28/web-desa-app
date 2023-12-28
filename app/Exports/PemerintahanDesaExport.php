<?php

namespace App\Exports;

use App\Models\PemerintahanDesa;
use Maatwebsite\Excel\Concerns\FromCollection;

class PemerintahanDesaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PemerintahanDesa::all([
            'nama',
            'jabatan',
            'tmpt_lahir',
            'jenis_kelamin',
            'tgl_lahir',
            'alamat',
            'no_telepon',
            'no_sk',
            'tgl_sk',
    
        ]);
    }

    public function heading(): array
    {
        return [
            'Nama',
            'Jabatan',
            'Tempat Lahir',
            'Jenis Kelamin',
            'Tanggal Lahir',
            'Alamat',
            'No Telepon',
            'No SK',
            'Tanggal SK',


        ];
    }
}
