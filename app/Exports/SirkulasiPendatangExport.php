<?php

namespace App\Exports;

use App\Models\SirkulasiPendatang;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class SirkulasiPendatangExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = SirkulasiPendatang::query()
            ->select(
                'sirkulasi_pendatang.nama',
                'sirkulasi_pendatang.NIK',
                'sirkulasi_pendatang.jenis_kelamin',
                'sirkulasi_pendatang.tgl_datang',
                'sirkulasi_pendatang.alamat_sblm',
                'sirkulasi_pendatang.alamat_skrg',
            );
            
        if ($this->request->has('tgl_datang_start') && $this->request->has('tgl_datang_end')) {
            $query->whereBetween('sirkulasi_pendatang.tgl_datang', [
                $this->request->get('tgl_datang_start'),
                $this->request->get('tgl_datang_end')
            ]);
        }

        return $query->get();
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
