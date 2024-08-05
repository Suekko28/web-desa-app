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
            'sirkulasi_pindah.tgl_pindah',
            'sirkulasi_pindah.alasan',
            'sirkulasi_pindah.alamat_pindah',
            'penduduk.NIK as penduduk_NIK',
            'penduduk.nama as penduduk_nama',


        )
        ->join('penduduk', 'penduduk.id', '=', 'sirkulasi_pindah.penduduk_id');
    

        // Filter berdasarkan tanggal pindah
        if ($this->request->has('tgl_pindah_start') && $this->request->has('tgl_pindah_end')) {
            $query->whereBetween('sirkulasi_pindah.tgl_pindah', [
                $this->request->get('tgl_pindah_start'),
                $this->request->get('tgl_pindah_end')
            ]);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'NIK Penduduk',
            'Nama Penduduk',
            'Tanggal Pindah',
            'Alasan',
            'Alamat Pindah'
        ];
    }

    public function map($row): array
    {
        return [
            $row->penduduk_NIK,
            $row->penduduk_nama,
            Carbon::parse($row->tgl_pindah)->format('d-m-Y'),
            $row->alasan,
            $row->alamat_pindah
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
