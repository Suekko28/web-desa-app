<?php

namespace App\DataTables\Scopes;

use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTableScope;

class SirkulasiPindahScope implements DataTableScope
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
        // Tambahkan kondisi filter berdasarkan tgl_pindah jika ada
        if ($this->request->has('tgl_pindah_start') && $this->request->has('tgl_pindah_end')) {
            $query->whereBetween('tgl_pindah', [
                $this->request->get('tgl_pindah_start'),
                $this->request->get('tgl_pindah_end')
            ]);
        }

        // Tambahkan filter lain sesuai kebutuhan
        return $query;
    }
}
