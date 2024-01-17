<?php

namespace App\DataTables;

use App\Models\LPJBelanja;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LPJBelanjaDataTable extends DataTable
{
    private $id_barang_jasa;
    public function __construct($id = null)
    {
        $this->id_barang_jasa = $id;
    }

    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        //.$this->id_barang_jasa;
        $actionBtn = '<div class="col">
        <a href="' . route('lpj-belanja.index').'/'.$this->id_barang_jasa.'/{{ $id }}/edit" name="edit" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>';

        $actionBtn .= '<a href="javascript:void(0)" onclick="confirmDelete($(this))"
            route="' . route('lpj-belanja.index') .'/'.$this->id_barang_jasa .'/{{ $id }}" class="btn btn-danger mt-2"><i class="fa-solid fa-trash-can"></i></a>';

        $actionBtn .= '</div>';
        $dataTable=(new EloquentDataTable($query))
        ->addColumn('action', $actionBtn)
        ->rawColumns(['action'])
        ->setRowId('id');
        $dataTable->filter(function($query){
            $query->where('id_barang_jasa','=',$this->id_barang_jasa);
        });
        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\LPJBelanja $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(LPJBelanja $model): QueryBuilder
    {
        return $model->newQuery()
            ->select(
                'lpj-belanja.id as id',
                'lpj-belanja.nama_barang as nama_barang',
                'lpj-belanja.dana_desa as dana_desa',
                'lpj-belanja.volume_qty as volume_qty',
                'lpj-belanja.satuan as satuan',
                'lpj-belanja.harga as harga',
                'lpj-belanja.nama_barang as tim_pemeriksa',
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
            ->addClass('rounded')
            ->action('function() {
                window.location.href = "'.route('lpj-belanja.create',['id'=>$this->id_barang_jasa]).'";
            }'),
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
                window.location.href = "'.route('lpj-belanja.generate-pdf',['id'=>$this->id_barang_jasa]).'";
            }'),

        ];

        return $this->builder()
            ->setTableId('pembelanjaan-table')
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
            Column::make('nama_barang'),
            Column::make('volume_qty'),
            Column::make('satuan'),
            Column::make('harga'),
            Column::make('dana_desa'),
            Column::make('tim_pemeriksa'),
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
        return 'LPJBelanja_' . date('YmdHis');
    }
}
