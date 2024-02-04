<?php

namespace App\DataTables;

use App\Models\LPJTimPemeriksa;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LPJTimPemeriksaDataTable extends DataTable
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
        <a href="' . route('lpj-timpemeriksa.index') . '/{{ $id }}/edit" name="edit" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>';

        $actionBtn .= '<a href="javascript:void(0)" onclick="confirmDelete($(this))"
            route="' . route('lpj-timpemeriksa.index') . '/{{ $id }}" class="btn btn-danger mt-2"><i class="fa-solid fa-trash-can"></i></a>';

        $actionBtn .= '</div>';

        return (new EloquentDataTable($query))
        ->addColumn('id', function ($data) {
            // Increment rowIndex for each row
            $this->rowIndex++;
            return '' . $this->rowIndex;
        })
            ->addColumn('action', $actionBtn)
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\LPJTimPemeriksa $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(LPJTimPemeriksa $model): QueryBuilder
    {
        return $model->newQuery()
        ->select(
            'lpj_timpemeriksa.id as id',
            'lpj_timpemeriksa.NIP as NIP',
            'lpj_timpemeriksa.nama as nama',
            'lpj_timpemeriksa.jabatan as jabatan',
            'lpj_timpemeriksa.tgl_pemeriksa as tgl_pemeriksa',
            'lpj_timpemeriksa.nomor as nomor',
            'lpj_timpemeriksa.tahun as tahun',
            'lpj_timpemeriksa.alamat as alamat',
            'lpj_timpemeriksa.updated_at as updated_at',
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
            // Button::make('csv')
            // ->addClass('btn-warning rounded')
            // ->text('CSV'),
            // Button::make('excel')
            // ->addClass('btn-success rounded')
            // ->text('Excel'),
            // Button::make('pdf')
            // ->addClass('btn-danger rounded')
            // ->text('PDF')
            // ->action('function() {
            //     window.location.href = "'.route('pemerintahan-BPD.pdf-template').'";
            // }'),
        ];

        return $this->builder()
            ->setTableId('lpj_timpemeriksa-table')
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
                ->title('No')
                ->width(10),
            Column::make('NIP'),
            Column::make('nama'),
            Column::make('jabatan'),
            Column::make('tgl_pemeriksa'),
            Column::make('nomor'),
            Column::make('tahun'),
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
        return 'LPJTimPemeriksa_' . date('YmdHis');
    }
}
