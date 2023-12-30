<?php

namespace App\Exports;

use App\Models\SirkulasiPendatang;
use Maatwebsite\Excel\Concerns\FromCollection;

class SirkulasiPendatangExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return  SirkulasiPendatang::all([
            'nama',
            'NIK',
            'jenis_kelamin',
            'tgl_datang',
            'alamat_sblm',
            'alamat_skrg',
        ]);
    }

    public function heading(): array
    {
        return [
            'Nama',
            'NIK',
            'Jenis Kelamin',
            'Tanggal Datang',
            'Alamat Sebelum',
            'Alamat Sesudah'

        ];
    }


}


