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
            'penduduk.nama as nama',
            'penduduk.jabatan as jabatan',
            \DB::raw('CASE WHEN jenis_kelamin = 1 THEN "Laki-Laki" ELSE "Perempuan" END AS jenis_kelamin'),
            'penduduk.tmpt_lahir as tmpt_lahir',
            'penduduk.tgl_lahir as tgl_lahir',
            'penduduk.alamat as alamat',
            'penduduk.updated_at as updated_at',
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
            Button::make('add'),
            Button::make('export'),

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
            Column::make('nama'),
            Column::make('jabatan'),
            Column::make('jenis_kelamin'),
            Column::make('tmpt_lahir'),
            Column::make('tgl_lahir'),
            Column::make('alamat'),
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
        return 'Penduduk_' . date('YmdHis');
    }
}
