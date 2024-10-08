<?php

namespace App\DataTables;

use App\Models\LPJBelanja;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LPJBelanjaDataTable extends DataTable
{

    protected $rowIndex = 0;

    private $barangjasa_id;
    public function __construct($barangjasa_id = null)
    {
        $this->barangjasa_id = $barangjasa_id;
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
        <a href="' . route('lpj-belanja.index') . '/' . $this->barangjasa_id . '/{{ $id }}/edit" name="edit" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>';

        $actionBtn .= '<a href="javascript:void(0)" onclick="confirmDelete($(this))"
            route="' . route('lpj-belanja.index') . '/' . $this->barangjasa_id . '/{{ $id }}" class="btn btn-danger mt-2"><i class="fa-solid fa-trash-can"></i></a>';

        $actionBtn .= '</div>';
        $dataTable = (new EloquentDataTable($query))
            ->addColumn('id', function ($data) {
                // Increment rowIndex for each row
                $this->rowIndex++;
                return '' . $this->rowIndex;
            })
            ->editColumn('created_at', function ($data) {
                return Carbon::parse($data->created_at)->format('d-m-Y H:i:s');
            })
            ->editColumn('updated_at', function ($data) {
                return Carbon::parse($data->updated_at)->format('d-m-Y H:i:s');
            })
            ->editColumn('harga', function ($data) {
                return 'Rp.' . number_format($data->harga, 0, ',', '.');
            })
            ->filter(function ($query) {
                if (request()->has('search') && !empty(request()->get('search')['value'])) {
                    $search = request()->get('search')['value'];
                    $query->where(function ($q) use ($search) {
                        $q->whereRaw('LOWER(lpj-belanja.nama_barang) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(lpj-belanja.harga) LIKE ?', ["%{$search}%"]);
                    });
                }
            })
            ->addColumn('action', $actionBtn)
            ->rawColumns(['action'])
            ->setRowId('id');
        $dataTable->filter(function ($query) {
            $query->where('barangjasa_id', '=', $this->barangjasa_id);
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
                'lpj-belanja.volume_qty as volume_qty',
                'lpj-belanja.satuan as satuan',
                'lpj-belanja.harga as harga',
                'lpj-belanja.created_at as created_at',
                'lpj-belanja.updated_at as updated_at',
                'users.nama as user_nama',

            )
            ->join('users', 'users.id', '=', 'lpj-belanja.user_id')
            ->orderBy('created_at', 'desc');

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
                window.location.href = "' . route('lpj-belanja.create', ['id' => $this->barangjasa_id]) . '";
            }'),
            // Button::make('csv')
            //     ->addClass('btn-warning rounded')
            //     ->text('CSV'),
            // Button::make('excel')
            //     ->addClass('btn-success rounded')
            //     ->text('Excel'),
            Button::make('pdf')
                ->addClass('btn-danger rounded')
                ->text('PDF')
                ->action('function() {
                window.location.href = "' . route('lpj-belanja.generate-pdf', ['id' => $this->barangjasa_id]) . '";
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
        return 'LPJBelanja_' . date('YmdHis');
    }
}
