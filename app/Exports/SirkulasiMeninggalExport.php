<?php

namespace App\Exports;

use App\Models\SirkulasiMeninggal;
use Maatwebsite\Excel\Concerns\FromCollection;

class SirkulasiMeninggalExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SirkulasiMeninggal::all([
            'nama',
            'NIK_penduduk',
            'tgl_meninggal',
            'sebab',
        ]);
    }

    public function heading(): array
    {
        return [
            'Nama',
            'NIK Penduduk',
            'Tanggal Meninggal',
            'Sebab',

        ];
    }

}
