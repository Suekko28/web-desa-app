<?php

namespace App\DataTables;

use App\Models\SirkulasiMelahirkan;
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
                        $q->whereRaw('LOWER(sirkulasi_melahirkans.nama) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(sirkulasi_melahirkans.tmpt_lahir) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(sirkulasi_melahirkans.tgl_lahir) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(sirkulasi_melahirkans.NKK_keluarga) LIKE ?', ["%{$search}%"]);
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
     * @param \App\Models\SirkulasiMelahirkan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SirkulasiMelahirkan $model): QueryBuilder
    {
        return $model->newQuery()
            ->select(
                'sirkulasi_melahirkans.id as id',
                'sirkulasi_melahirkans.nama as nama',
                'sirkulasi_melahirkans.tmpt_lahir as tmpt_lahir',
                'sirkulasi_melahirkans.tgl_lahir as tgl_lahir',
                \DB::raw('CASE WHEN jenis_kelamin = 1 THEN "Laki-Laki" ELSE "Perempuan" END AS jenis_kelamin'),
                'sirkulasi_melahirkans.NKK_keluarga as NKK_keluarga',
                'sirkulasi_melahirkans.created_at as created_at',
                'sirkulasi_melahirkans.updated_at as updated_at',
                'users.nama as user_nama' 
            )
            ->join('users', 'users.id', '=', 'sirkulasi_melahirkans.user_id')
            ->orderBy('sirkulasi_melahirkans.created_at', 'desc');
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
            Column::make('id')
            ->title('No')
            ->width(10),
            Column::make('nama'),
            Column::make('tmpt_lahir'),
            Column::make('tgl_lahir'),
            Column::make('jenis_kelamin'),
            Column::make('NKK_keluarga')
            ->exportFormat('integer'),
            Column::make('created_at')
            ->exportable(false),
            Column::make('updated_at')
            ->exportable(false),
            Column::make('user_nama')
                ->title('Update by')
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
        return 'SirkulasiMelahirkan_' . date('YmdHis');
    }
}
