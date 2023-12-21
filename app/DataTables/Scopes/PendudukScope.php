<?php

namespace App\DataTables\Scopes;

use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTableScope;

class PendudukScope implements DataTableScope
{
    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    protected $request;
    // Tambahkan Class Request
    public function __construct(Request $request)
    {
        $this->request  = $request;
    }

    public function apply($query)
    {
        $filters =  [
            'age',
        ];

        foreach ($filters as $field) {
            if ($this->request->has($field)) {
                if($this->request->get($field) !== null){
                    $query->where($field, '=', $this->request->get($field));
                }
            }
        }
    }
}
