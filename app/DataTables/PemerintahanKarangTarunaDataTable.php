<?php

namespace App\DataTables;

use App\Models\PemerintahanKarangTaruna;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PemerintahanKarangTarunaDataTable extends DataTable
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
        <a href="' . route('pemerintahan-karang-taruna.index') . '/{{ $id }}/edit" name="edit" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>';
        
        $actionBtn .= '<a href="javascript:void(0)" onclick="confirmDelete($(this))"
            route="' . route('pemerintahan-karang-taruna.index') . '/{{ $id }}" class="btn btn-danger mt-2"><i class="fa-solid fa-trash-can"></i></a>';

        $actionBtn.='</div>';

        return (new EloquentDataTable($query))
            ->addColumn('action', $actionBtn)
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PemerintahanKarangTaruna $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PemerintahanKarangTaruna $model): QueryBuilder
    {
        return $model->newQuery()
        ->select(
            'pemerintahan_karang_taruna.id as id',
            'pemerintahan_karang_taruna.nama as nama',
            'pemerintahan_karang_taruna.jabatan as jabatan',
            \DB::raw('CASE WHEN jenis_kelamin = 1 THEN "Laki-Laki" ELSE "Perempuan" END AS jenis_kelamin'),
            'pemerintahan_karang_taruna.tmpt_lahir as tmpt_lahir',
            'pemerintahan_karang_taruna.tgl_lahir as tgl_lahir',
            'pemerintahan_karang_taruna.alamat as alamat',
            'pemerintahan_karang_taruna.updated_at as updated_at',
            'pemerintahan_karang_taruna.no_telepon as no_telepon',
            'pemerintahan_karang_taruna.no_sk as no_sk',
            'pemerintahan_karang_taruna.tgl_sk as tgl_sk',
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

        ];
        return $this->builder()
                    ->setTableId('pemerintah-karang-taruna-table')
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
            Column::make('nama'),
            Column::make('jabatan'),
            Column::make('jenis_kelamin'),
            Column::make('tmpt_lahir'),
            Column::make('tgl_lahir'),
            Column::make('alamat'),
            Column::make('no_telepon'),
            Column::make('no_sk'),
            Column::make('tgl_sk'),
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
        return 'PemerintahanKarangTaruna_' . date('YmdHis');
    }
}
