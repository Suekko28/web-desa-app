<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;
use Illuminate\Http\Request;

class SirkulasiMelahirkanScope implements DataTableScope
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
        if ($this->request->has('tgl_lahir_start') && $this->request->has('tgl_lahir_end')) {
            $query->whereBetween('tgl_lahir', [
                $this->request->get('tgl_lahir_start'),
                $this->request->get('tgl_lahir_end')
            ]);
        }

        // Tambahkan filter lain sesuai kebutuhan Anda
        return $query;
    }
}
