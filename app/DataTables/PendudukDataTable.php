<?php

namespace App\DataTables;

use App\Models\Penduduk;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PendudukDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $actionBtn='<div class="col">
        <a href="' . route('penduduk.index') . '/{{ $id }}/edit" name="edit" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>';
        
        $actionBtn .= '<a href="javascript:void(0)" onclick="confirmDelete($(this))"
            route="' . route('penduduk.index') . '/{{ $id }}" class="btn btn-danger mt-2"><i class="fa-solid fa-trash-can"></i></a>';

        $actionBtn .= '<a href="javascript:void(0)" onclick="confirmDelete($(this))"
        route="' . route('penduduk.index') . '/{{ $id }}" class="btn btn-danger mt-2"><i class="fa-solid fa-eye"></i></a>';
        $actionBtn.='</div>';

        return (new EloquentDataTable($query))
            ->addColumn('action', $actionBtn)
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Penduduk $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Penduduk $model): QueryBuilder
    {
        return $model->newQuery()
        ->select(
            'penduduk.id as id',
            'penduduk.tgl_pindah_masuk as tgl_pindah_masuk',
            'penduduk.tgl_lapor as tgl_lapor',
            'penduduk.NIK as NIK',
            'penduduk.NKK as NKK',
            'penduduk.nama as nama',
            'penduduk.tempat_lahir as tempat_lahir',
            'penduduk.tgl_lahir as tgl_lahir',
            'penduduk.jenis_kelamin as jenis_kelamin',
            'penduduk.agama as agama',
            'penduduk.kewarganegaraan as kewarganegaraan',
            'penduduk.status_pernikahan as status_pernikahan',
            'penduduk.dusun as dusun',
            'penduduk.rt as rt',
            'penduduk.rw as rw',
            'penduduk.alamat as alamat',
            'penduduk.pendidikan as pendidikan',
            'penduduk.pekerjaan as pekerjaan',
            'penduduk.kepemilikan_bpjs as kepemilikan_bpjs',
            'penduduk.kepemilikan_e_ktp as kepemilikan_e_ktp',
            'penduduk.nama_ibu as nama_ibu',
            'penduduk.nama_ayah as nama_ayah',
        );
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        $btn = [
            Button::make('add')->text('+ Tambah Data'),
            Button::make('export')->text('Export Data'),
            [
                'text'      => 'Import Data',
                'className' => 'btn-info',
            ],
        ];
        return $this->builder()
                    ->setTableId('penduduk-desa-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0,'asc')
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
                ->width(10),
            Column::make('NIK'),
            Column::make('NKK'),
            Column::make('nama'),
            Column::make('rt'),
            Column::make('rw'),
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
        return 'Penduduk_' . date('YmdHis');
    }
}
