<?php

namespace App\Exports;

use App\Models\PemerintahanKadus;
use Maatwebsite\Excel\Concerns\FromCollection;

class PemerintahanKadusExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PemerintahanKadus::all([
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
