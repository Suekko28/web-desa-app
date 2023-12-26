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
            'pendidikan',
            'pekerjaan',
            'kepemilikan_bpjs',
            'kepemilikan_e_ktp',
            'jenis_kelamin',
            'status_pernikahan',
            'agama',
            'rt',
            'rw',
            
        ];
        foreach ($filters as $field) {
            if ($this->request->has($field)) {
                if($this->request->get($field) !== null){
                    $query->where($field, '=', $this->request->get($field));
                }
            }
        }
        $mn='0';
        $mx='999';
        if($this->request->has('usia_mn')){
            if($this->request->get('usia_mn')!=null){
            $mn=$this->request->get('usia_mn');
                if((int)$mn<0){
                    $mn='0';
                }
            }
            $query->where('usia', '>=', $mn);

        }

        if($this->request->has('usia_mx')){
            if($this->request->get('usia_mx')!=null){
            $mx=$this->request->get('usia_mx');
                if((int)$mx>999){
                    $mx='999';
                }
            }
            $query->where('usia', '<=', $mx);

        }
        
        
    }
}
