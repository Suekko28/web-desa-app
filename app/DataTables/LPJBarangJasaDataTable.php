<?php

namespace App\DataTables;

use App\Models\LPJBarangJasa;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LPJBarangJasaDataTable extends DataTable
{
    protected $rowIndex = 0;

    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $this->rowIndex = 0;

        $actionBtn = '<div class="col">
        <a href="' . route('lpj-barangjasa.index') . '/{{ $id }}/edit" name="edit" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>';

        $actionBtn .= '<a href="javascript:void(0)" onclick="confirmDelete($(this))"
            route="' . route('lpj-barangjasa.index') . '/{{ $id }}" class="btn btn-danger mt-2"><i class="fa-solid fa-trash-can"></i></a>';

        $actionBtn .= '<div class="col">
        <a href="' . route('lpj-belanja.index') . '/{{ $id }}" name="view" class="btn btn-success mt-2"><i class="fa-solid fa-basket-shopping"></i></a>';

        $actionBtn .= '</div>';

        $actionBtn .= '<div class="col">
        <a href="' . route('lpj-barangjasa.index') . '/{{ $id }}" name="view" class="btn btn-primary mt-2"><i class="fa-solid fa-eye"></i></a>';

        $actionBtn .= '</div>';

        return (new EloquentDataTable($query))
            ->addColumn('id', function ($data) {
                // Increment rowIndex for each row
                $this->rowIndex++;
                return '' . $this->rowIndex;
            })
            ->editColumn('tgl_pesanan', function ($data) {
                return Carbon::parse($data->tgl_pesanan)->format('d-m-Y');
            })
            ->editColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->format('d-m-Y H:i:s');
            })
            ->editColumn('updated_at', function ($data) {
                return Carbon::parse($data->updated_at)->format('d-m-Y H:i:s');
            })
            ->filter(function ($query) {
                if (request()->has('search') && !empty(request()->get('search')['value'])) {
                    $search = request()->get('search')['value'];
                    $query->where(function ($q) use ($search) {
                        $q->whereRaw('LOWER(lpj-barang-jasa.no_berita_acara) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(lpj-barang-jasa.nama_pelaksana_kegiatan) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(lpj-barang-jasa.no_berita_acara) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(lpj-barang-jasa.tgl_pesanan) LIKE ?', ["%{$search}%"]);
                    });
                }
            })
            ->addColumn('action', $actionBtn)
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\LPJBarangJasa $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(LPJBarangJasa $model): QueryBuilder
    {
        return $model->newQuery()
            ->select(
                'lpj-barang-jasa.id as id',
                'lpj-barang-jasa.no_pesanan_brg as no_pesanan_barang',
                'lpj-barang-jasa.no_berita_acara as no_berita_acara',
                'lpj-barang-jasa.no_berita_acara_pemeriksaan as no_berita_acara_pemeriksaan',
                'lpj-barang-jasa.dana_desa as dana_desa',
                'lpj-barang-jasa.nama_pelaksana_kegiatan as nama_pelaksana_kegiatan',
                'lpj-barang-jasa.sk_tpk as sk_tpk',
                'lpj-barang-jasa.nama_rincian_spp as nama_rincian_spp',
                'lpj-barang-jasa.uraian_kwitansi as uraian_kwitansi',
                'lpj-barang-jasa.tgl_pesanan as tgl_pesanan',
                'lpj-barang-jasa.tgl_bast as tgl_bast',
                'lpj-barang-jasa.jatuh_tempo as jatuh_tempo',
                'lpj-barang-jasa.jatuh_pemeriksaan as jatuh_pemeriksaan',
                'lpj-barang-jasa.keterangan as keterangan',
                'lpj-barang-jasa.nama_toko as nama_toko',
                'lpj-barang-jasa.pemilik_toko as pemilik_toko',
                'lpj-barang-jasa.lampiran as lampiran',
                'lpj-barang-jasa.perihal as perihal',
                'lpj-barang-jasa.alamat as alamat',
                'lpj-barang-jasa.created_at as created_at',
                'lpj-barang-jasa.updated_at as updated_at',
                \DB::raw("CONCAT(lpj_timpemeriksa.NIP, ' - ',lpj_timpemeriksa.nama) as tim_pemeriksa"),
                'users.nama as user_nama',

            )
            ->join('users', 'users.id', '=', 'lpj-barang-jasa.user_id')
            ->orderBy('created_at', 'desc')
            ->join('lpj_timpemeriksa', 'lpj_timpemeriksa.id', '=', 'lpj-barang-jasa.timpemeriksa_id');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        $btn = [
            Button::make('add')
                ->text('+ Tambah Data')
                ->addClass('rounded'),
            // Button::make('csv')
            //     ->addClass('btn-warning rounded')
            //     ->text('CSV'),
            // Button::make('excel')
            //     ->addClass('btn-success rounded')
            //     ->text('Excel'),
            // Button::make('pdf')
            //     ->addClass('btn-danger rounded')
            //     ->text('PDF')
            //     ->action('function() {
            //     window.location.href = "' . route('lpj-barangjasa.generate-pdf') . '";
            // }'),


        ];

        return $this->builder()
            ->setTableId('lpj-barang-jasa-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'asc')
            ->buttons($btn)
            ->lengthMenu([10, 50, 100]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')
                ->title('No'),
            Column::make('no_pesanan_barang'),
            Column::make('no_berita_acara'),
            Column::make('nama_pelaksana_kegiatan'),
            Column::make('tgl_pesanan'),
            Column::make('tim_pemeriksa'),
            Column::make('nama_toko'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::make('user_nama')
                ->title('Update By'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'LPJBarangJasa_' . date('YmdHis');
    }
}
