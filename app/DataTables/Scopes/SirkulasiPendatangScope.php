<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;
use Illuminate\Http\Request;

class SirkulasiPendatangScope implements DataTableScope
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
        if ($this->request->has('tgl_datang_start') && $this->request->has('tgl_datang_end')) {
            $query->whereBetween('sirkulasi_pendatang.tgl_datang', [
                $this->request->get('tgl_datang_start'),
                $this->request->get('tgl_datang_end')
            ]);
        }

        // Tambahkan filter lain sesuai kebutuhan Anda
        return $query;
    }
}
