<?php

namespace App\Exports;

use App\Models\SirkulasiPindah;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Carbon\Carbon;

class SirkulasiPindahExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting
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
        $query = SirkulasiPindah::query()->select(
            'nama_penduduk',
            'NIK',
            'tgl_pindah',
            'alasan',
            'alamat_pindah'
        );

        // Filter berdasarkan tanggal pindah
        if ($this->request->has('tgl_pindah_start') && $this->request->has('tgl_pindah_end')) {
            $query->whereBetween('tgl_pindah', [
                $this->request->get('tgl_pindah_start'),
                $this->request->get('tgl_pindah_end')
            ]);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Nama Penduduk',
            'NIK Penduduk',
            'Tanggal Pindah',
            'Alasan',
            'Alamat Pindah'
        ];
    }

    public function map($row): array
    {
        return [
            $row->nama_penduduk,
            (int)$row->NIK,
            Carbon::parse($row->tgl_pindah)->format('d-m-Y'),
            $row->alasan,
            $row->alamat_pindah
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
