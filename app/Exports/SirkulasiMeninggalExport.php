<?php

namespace App\Exports;

use App\Models\SirkulasiMeninggal;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Carbon\Carbon;

class SirkulasiMeninggalExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting
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
        $query = SirkulasiMeninggal::query()->select(
            'nama_penduduk',
            'NIK_penduduk',
            'tgl_meninggal',
            'sebab'
        );

        // Filter berdasarkan tanggal
        if ($this->request->has('tgl_meninggal_start') && $this->request->has('tgl_meninggal_end')) {
            $query->whereBetween('tgl_meninggal', [
                $this->request->get('tgl_meninggal_start'),
                $this->request->get('tgl_meninggal_end')
            ]);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Nama Penduduk',
            'NIK Penduduk',
            'Tanggal Meninggal',
            'Sebab'
        ];
    }

    public function map($row): array
    {
        return [
            $row->nama_penduduk,
            (int)$row->NIK_penduduk,
            Carbon::parse($row->tgl_meninggal)->format('d-m-Y'),
            $row->sebab
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER,
            'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
