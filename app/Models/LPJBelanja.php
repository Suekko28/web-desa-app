<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class LPJBelanja extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lpj-belanja';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_barang_jasa',
        'nama_barang',
        'volume_qty',
        'dana_desa',
        'tim_pemeriksa',
        'satuan',
        'harga',
    ];
    public function LPJBarangJasa(): HasOne{
        return $this->hasOne(LPJBarangJasa::class,'id_barang_jasa','id');
    }  
}
