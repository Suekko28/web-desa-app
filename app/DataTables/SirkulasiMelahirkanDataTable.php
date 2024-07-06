<?php

namespace App\DataTables;

use App\Models\Anak;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SirkulasiMelahirkanDataTable extends DataTable
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
        <a href="' . route('sirkulasi-melahirkan.index') . '/{{ $id }}/edit" name="edit" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>';

        $actionBtn .= '<a href="javascript:void(0)" onclick="confirmDelete($(this))"
            route="' . route('sirkulasi-melahirkan.index') . '/{{ $id }}" class="btn btn-danger mt-2"><i class="fa-solid fa-trash-can"></i></a>';

        $actionBtn .= '</div>';

        return (new EloquentDataTable($query))
            ->addColumn('id', function ($data) {
                // Increment rowIndex for each row
                $this->rowIndex++;
                return '' . $this->rowIndex;
            })
            ->editColumn('tgl_lahir', function ($data) {
                return Carbon::parse($data->tgl_lahir)->format('d-m-Y');
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
                        $q->whereRaw('LOWER(anak.nama) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(anak.tmpt_lahir) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(anak.tgl_lahir) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(anak.NKK_keluarga) LIKE ?', ["%{$search}%"]);
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
     * @param \App\Models\Anak $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Anak $model): QueryBuilder
    {
        return $model->newQuery()
            ->select(
                'anak.id as id',
                'anak.nama as nama',
                'anak.tmpt_lahir as tmpt_lahir',
                'anak.tgl_lahir as tgl_lahir',
                \DB::raw('CASE WHEN jenis_kelamin = 1 THEN "Laki-Laki" ELSE "Perempuan" END AS jenis_kelamin'),
                'anak.NKK_keluarga as NKK_keluarga',
                'anak.created_at as created_at',
                'anak.updated_at as updated_at',
                'users.nama as user_nama' // Ensure this column name matches your database
            )
            ->join('users', 'users.id', '=', 'anak.user_id')
            ->orderBy('anak.created_at', 'desc');
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
                    window.location.href = "' . route('sirkulasi-melahirkan.generate-pdf') . '";
                }')
        ];
        return $this->builder()
            ->setTableId('sirkulasi-melahirkan-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'asc')
            ->buttons($btn)
            ->lengthMenu([10, 50, 100])
            ->responsive(true);
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
            Column::make('nama'),
            Column::make('tmpt_lahir'),
            Column::make('tgl_lahir'),
            Column::make('jenis_kelamin'),
            Column::make('NKK_keluarga'),
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
        return 'SirkulasiMelahirkan_' . date('YmdHis');
    }
}
