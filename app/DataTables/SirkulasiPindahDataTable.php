<?php

namespace App\DataTables;

use App\Models\Penduduk;
use App\Models\SirkulasiPindah;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SirkulasiPindahDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $actionBtn = '<div class="col">
        <a href="' . route('sirkulasi-pindah.index') . '/{{ $id }}/edit" name="edit" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>';

        $actionBtn .= '<a href="javascript:void(0)" onclick="confirmDelete($(this))"
            route="' . route('sirkulasi-pindah.index') . '/{{ $id }}" class="btn btn-danger mt-2"><i class="fa-solid fa-trash-can"></i></a>';

        $actionBtn .= '</div>';

        return (new EloquentDataTable($query))
            ->addColumn('action', $actionBtn)
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SirkulasiPindah $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SirkulasiPindah $model): QueryBuilder
    {
        return $model->newQuery()
            ->select(
                'sirkulasi_pindah.id as id',
                'sirkulasi_pindah.NIK as NIK',
                'sirkulasi_pindah.tgl_pindah as tgl_pindah',
                'sirkulasi_pindah.alasan as alasan',
                'sirkulasi_pindah.alamat_pindah as alamat_pindah',
                'sirkulasi_pindah.created_at as created_at',
                'sirkulasi_pindah.updated_at as updated_at',
                'penduduk.nama as nama'
            )
            ->join('penduduk', function ($q) {
                $q->on('penduduk.NIK', '=', 'sirkulasi_pindah.NIK');
            });
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
            ->text('PDF')
            ->action('function() {
                window.location.href = "'.route('sirkulasi-meninggal.generate-pdf').'";
            }'),


        ];
        return $this->builder()
            ->setTableId('sirkulasi-pendatang')
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
            Column::make('id'),
            Column::make('NIK'),
            Column::make('nama'),
            Column::make('tgl_pindah'),
            Column::make('alasan'),
            Column::make('alamat_pindah'),
            Column::make('created_at'),
            Column::make('updated_at'),
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
        return 'SirkulasiPindah_' . date('YmdHis');
    }
}
