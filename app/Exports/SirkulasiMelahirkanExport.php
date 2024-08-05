<?php

namespace App\Exports;

use App\Models\SirkulasiMelahirkan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Carbon\Carbon;

class SirkulasiMelahirkanExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting
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
        $query = SirkulasiMelahirkan::query()
            ->select(
                'sirkulasi_melahirkans.nama',
                'sirkulasi_melahirkans.tmpt_lahir',
                'sirkulasi_melahirkans.tgl_lahir',
                'sirkulasi_melahirkans.jenis_kelamin',
                'penduduk.NKK as penduduk_NKK',
                // 'penduduk.nama as penduduk_nama'
            )
            ->join('penduduk', 'penduduk.id', '=', 'sirkulasi_melahirkans.penduduk_id');

        if ($this->request->has('tgl_lahir_start') && $this->request->has('tgl_lahir_end')) {
            $query->whereBetween('sirkulasi_melahirkans.tgl_lahir', [
                $this->request->get('tgl_lahir_start'),
                $this->request->get('tgl_lahir_end')
            ]);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'NKK',
            // 'Keluarga',
        ];
    }

    public function map($row): array
    {
        return [
            $row->nama,
            $row->tmpt_lahir,
            Carbon::parse($row->tgl_lahir)->format('d-m-Y'),
            $row->jenis_kelamin == 1 ? 'Laki-Laki' : 'Perempuan', // Ubah nilai jenis kelamin
            $row->penduduk_NKK,
            // $row->penduduk_nama,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'E' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}
