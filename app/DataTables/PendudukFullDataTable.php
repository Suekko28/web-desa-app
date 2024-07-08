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

class PendudukFullDataTable extends DataTable
{
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
        <a href="' . route('penduduk.index') . '/{{ $id }}/edit" name="edit" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>';

        $actionBtn .= '<a href="javascript:void(0)" onclick="confirmDelete($(this))"
            route="' . route('penduduk.index') . '/{{ $id }}" class="btn btn-danger mt-2"><i class="fa-solid fa-trash-can"></i></a>';

        $actionBtn .= '<div class="col">
        <a href="' . route('penduduk.index') . '/{{ $id }}" name="view" class="btn btn-warning mt-2"><i class="fa-solid fa-eye"></i></a>';

        $actionBtn .= '</div>';

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
                'penduduk.rw as tempat_lahir',
                'penduduk.rw as tgl_lahir',
                'penduduk.nama as nama',
                'penduduk.usia as usia',
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
                'penduduk.kepemilikan_bpjs',
                'penduduk.kepemilikan_e_ktp',
                'penduduk.nama_ibu',
                'penduduk.nama_ayah',
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
            Button::make('add')
                ->text('+ Tambah Data')
                ->addClass('rounded'),
            Button::make('csv')
                ->addClass('btn-warning rounded')
                ->text('CSV'),
            Button::make('excel')
                ->addClass('btn-success rounded')
                ->text('Excel'),
            Button::make('pdf')
                ->addClass('btn-danger rounded')
                ->text('PDF'),

        ];
        array_push($btn, Button::raw('Import Data')
            ->addClass('btn-info rounded')
            ->action("window.location = '" . route('penduduk.import-view') . "';"));


        return $this->builder()
            ->setTableId('penduduk-desa-table')
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
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(20)
                ->addClass('text-center'),
            Column::make('id')
                ->title('No')
                ->width(10),
            Column::make('NIK'),
            Column::make('NKK'),
            Column::make('nama'),
            Column::make('tgl_pindah_masuk'),
            Column::make('tgl_lapor'),
            Column::make('tempat_lahir'),
            Column::make('tgl_lahir'),
            Column::make('usia'),
            Column::make('jenis_kelamin'),
            Column::make('agama'),
            Column::make('kewarganegaraan'),
            Column::make('dusun'),
            Column::make('RT'),
            Column::make('RW'),
            Column::make('alamat'),
            Column::make('pendidikan'),
            Column::make('pekerjaan'),
            Column::make('kepemilikan_bpjs'),
            Column::make('kepemilikan_e_ktp'),
            Column::make('nama_ibu'),
            Column::make('nama_ayah'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'PendudukFull_' . date('YmdHis');
    }
}
