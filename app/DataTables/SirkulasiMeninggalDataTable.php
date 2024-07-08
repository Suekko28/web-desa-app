<?php

namespace App\DataTables;

use App\Models\SirkulasiMeninggal;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SirkulasiMeninggalDataTable extends DataTable
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
            <a href="' . route('sirkulasi-meninggal.index') . '/{{ $id }}/edit" name="edit" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>';

        $actionBtn .= '<a href="javascript:void(0)" onclick="confirmDelete($(this))"
            route="' . route('sirkulasi-meninggal.index') . '/{{ $id }}" class="btn btn-danger mt-2"><i class="fa-solid fa-trash-can"></i></a>';

        $actionBtn .= '</div>';

        return (new EloquentDataTable($query))
            ->addColumn('id', function ($data) {
                $this->rowIndex++;
                return '' . $this->rowIndex;
            })
            ->editColumn('tgl_meninggal', function ($data) {
                return Carbon::parse($data->tgl_meninggal)->format('d-m-Y');
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
                        $q->whereRaw('LOWER(penduduk.nama) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(sirkulasi_meninggal.NIK_penduduk) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(sirkulasi_meninggal.sebab) LIKE ?', ["%{$search}%"]);
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
     * @param \App\Models\SirkulasiMeninggal $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SirkulasiMeninggal $model): QueryBuilder
    {
        return $model->newQuery()
            ->select(
                'sirkulasi_meninggal.id as id',
                'sirkulasi_meninggal.NIK_penduduk as NIK_penduduk',
                'sirkulasi_meninggal.tgl_meninggal as tgl_meninggal',
                'sirkulasi_meninggal.sebab as sebab',
                'sirkulasi_meninggal.created_at as created_at',
                'sirkulasi_meninggal.updated_at as updated_at',
                'penduduk.nama as nama',
                'users.nama as user_nama'
            )
            ->join('penduduk', 'penduduk.NIK', '=', 'sirkulasi_meninggal.NIK_penduduk')
            ->join('users', 'users.id', '=', 'sirkulasi_meninggal.user_id')
            ->orderBy('sirkulasi_meninggal.created_at', 'desc');
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
                window.location.href = "' . route('sirkulasi-meninggal.generate-pdf') . '";
            }'),


        ];
        return $this->builder()
            ->setTableId('sirkulasi-meninggal-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'desc')
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
            Column::make('id')
                ->title('No')
                ->width(10),
            Column::make('nama'),
            Column::make('NIK_penduduk'),
            Column::make('tgl_meninggal'),
            Column::make('sebab'),
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
        return 'SirkulasiMeninggal_' . date('YmdHis');
    }
}
