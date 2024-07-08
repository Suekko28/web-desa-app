<?php

namespace App\DataTables;

use App\Models\SirkulasiPendatang;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SirkulasiPendatangDataTable extends DataTable
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
        $actionBtn = '<div class="col">
        <a href="' . route('sirkulasi-pendatang.index') . '/{{ $id }}/edit" name="edit" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>';

        $actionBtn .= '<a href="javascript:void(0)" onclick="confirmDelete($(this))"
            route="' . route('sirkulasi-pendatang.index') . '/{{ $id }}" class="btn btn-danger mt-2"><i class="fa-solid fa-trash-can"></i></a>';

        $actionBtn .= '</div>';

        return (new EloquentDataTable($query))
            ->addColumn('id', function ($data) {
                // Increment rowIndex for each row
                $this->rowIndex++;
                return '' . $this->rowIndex;
            })
            ->editColumn('tgl_datang', function ($data) {
                return Carbon::parse($data->tgl_datang)->format('d-m-Y');
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
                        $q->whereRaw('LOWER(sirkulasi_pendatang.NIK) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(sirkulasi_pendatang.nama) LIKE ?', ["%{$search}%"]);
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
     * @param \App\Models\SirkulasiPendatang $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SirkulasiPendatang $model): QueryBuilder
    {
        return $model->newQuery()
            ->select(
                'sirkulasi_pendatang.id as id',
                'sirkulasi_pendatang.NIK as NIK',
                'sirkulasi_pendatang.nama as nama',
                \DB::raw('CASE WHEN jenis_kelamin = 1 THEN "Laki-Laki" ELSE "Perempuan" END AS jenis_kelamin'),
                'sirkulasi_pendatang.tgl_datang as tgl_datang',
                'sirkulasi_pendatang.alamat_sblm as alamat_sblm',
                'sirkulasi_pendatang.alamat_skrg as alamat_skrg',
                'sirkulasi_pendatang.created_at as created_at',
                'sirkulasi_pendatang.updated_at as updated_at',
                'users.nama as user_nama' // Ensure this column name matches your database

            )
            ->join('users', 'users.id', '=', 'sirkulasi_pendatang.user_id')
            ->orderBy('sirkulasi_pendatang.created_at', 'desc');

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
                window.location.href = "' . route('sirkulasi-pendatang.generate-pdf') . '";
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
            Column::make('id')
            ->title('No')
            ->width(10),
            Column::make('nama'),
            Column::make('NIK'),
            Column::make('jenis_kelamin'),
            Column::make('tgl_datang'),
            Column::make('alamat_sblm'),
            Column::make('alamat_skrg'),
            Column::make('created_at')
                ->exportable(false),
            Column::make('updated_at')
                ->exportable(false),
            Column::make('user_nama')
                ->title('Update By')
                ->exportable(false),
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
        return 'SirkulasiPendatang_' . date('YmdHis');
    }
}
