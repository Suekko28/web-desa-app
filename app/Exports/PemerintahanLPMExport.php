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
        return PemerintahanLPM::all();
    }
}
