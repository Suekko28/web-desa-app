<?php

namespace App\Exports;

use App\Models\PemerintahanLPM;
use Maatwebsite\Excel\Concerns\FromCollection;

class PemerintahanLPMExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return PemerintahanLPM::all([
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
