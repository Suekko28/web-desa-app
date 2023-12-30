<?php

namespace App\Exports;

use App\Models\Anak;
use Maatwebsite\Excel\Concerns\FromCollection;

class SirkulasiMelahirkanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Anak::all([
            'nama',
            'tmpt_lahir',
            'tgl_lahir',
            'jenis_kelamin',
            'NKK_keluarga'
        ]);
    }

    public function heading(): array
    {
        return [
            'Nama',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'NKK Keluarga',

        ];
    }

}
