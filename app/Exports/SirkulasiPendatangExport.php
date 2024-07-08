<?php

namespace App\Exports;

use App\Models\SirkulasiPendatang;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class SirkulasiPendatangExport implements FromQuery, WithHeadings, WithMapping, WithColumnFormatting
{
    use Exportable;

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function query()
    {
        $query = SirkulasiPendatang::query()->select(
            'nama',
            'NIK',
            'jenis_kelamin',
            'tgl_datang',
            'alamat_sblm',
            'alamat_skrg'
        );

        if ($this->request->has('tgl_datang_start') && $this->request->has('tgl_datang_end')) {
            $query->whereBetween('tgl_datang', [
                $this->request->get('tgl_datang_start'),
                $this->request->get('tgl_datang_end')
            ]);
        }

        return $query;
    }

    public function headings(): array
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

    public function map($row): array
    {
        return [
            $row->nama,
            $row->NIK,
            $row->jenis_kelamin,
            Carbon::parse($row->tgl_datang)->format('d-m-Y'),
            $row->alamat_sblm,
            $row->alamat_skrg
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER,
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
