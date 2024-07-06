<?php

namespace App\DataTables;

use Carbon\Carbon;
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
        <a href="' . route('penduduk.index') . '/{{ $id }}/edit" name="edit" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>';

        $actionBtn .= '<a href="javascript:void(0)" onclick="confirmDelete($(this))"
            route="' . route('penduduk.index') . '/{{ $id }}" class="btn btn-danger mt-2"><i class="fa-solid fa-trash-can"></i></a>';

        $actionBtn .= '<div class="col">
        <a href="' . route('penduduk.index') . '/{{ $id }}" name="view" class="btn btn-primary mt-2"><i class="fa-solid fa-eye"></i></a>';

        $actionBtn .= '</div>';

        return (new EloquentDataTable($query))
            ->addColumn('id', function ($data) {
                // Increment rowIndex for each row
                $this->rowIndex++;
                return '' . $this->rowIndex;
            })
            ->addColumn('action', $actionBtn)
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
                        $q->whereRaw('LOWER(penduduk.nama) LIKE ?', ["%{$search}%"])
                          ->orWhereRaw('LOWER(penduduk.NIK) LIKE ?', ["%{$search}%"])
                          ->orWhereRaw('LOWER(penduduk.NKK) LIKE ?', ["%{$search}%"])
                          ->orWhereRaw('LOWER(penduduk.usia) LIKE ?', ["%{$search}%"])
                          ->orWhereRaw('LOWER(penduduk.rt) LIKE ?', ["%{$search}%"])
                          ->orWhereRaw('LOWER(penduduk.created_at) LIKE ?', ["%{$search}%"])
                          ->orWhereRaw('LOWER(penduduk.updated_at) LIKE ?', ["%{$search}%"]);
                        //   ->orWhereRaw('LOWER(users.nama) LIKE ?', ["%{$search}%"]); // Correctly referencing users.nama
                    });
                }
            })
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
                'penduduk.NIK as NIK',
                'penduduk.NKK as NKK',
                'penduduk.nama as nama',
                'penduduk.usia as usia',
                'penduduk.rt as rt',
                'penduduk.rw as rw',
                'penduduk.created_at as created_at',
                'penduduk.updated_at as updated_at',
                'users.nama as user_nama'
            )
            ->orderBy('created_at', 'desc')
            ->leftJoin('users', 'penduduk.user_id', '=', 'users.id');
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
            // Button::make('pdf')
            //     ->addClass('btn-danger rounded')
            //     ->text('PDF'),

        ];
        array_push($btn, Button::raw('Import Data')
            ->addClass('btn-info rounded')
            ->action("window.location = '" . route('penduduk.import-view') . "';"));


        return $this->builder()
            ->setTableId('penduduk-desa-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'desc')
            ->buttons($btn)
            ->lengthMenu([10, 50, 100])
            ->searching(true);



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
            Column::make('nama'),
            Column::make('NIK'),
            Column::make('NKK'),
            Column::make('usia'),
            Column::make('rt'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::make('user_nama')
                ->title('Update by'),
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
