<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;
use Illuminate\Http\Request;


class SirkulasiMeninggalScope implements DataTableScope
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        // Tambahkan kondisi filter berdasarkan tgl_meninggal jika ada
        if ($this->request->has('tgl_meninggal_start') && $this->request->has('tgl_meninggal_end')) {
            $query->whereBetween('tgl_meninggal', [
                $this->request->get('tgl_meninggal_start'),
                $this->request->get('tgl_meninggal_end')
            ]);
        }

        // Tambahkan filter lain sesuai kebutuhan
        return $query;
    }
}
