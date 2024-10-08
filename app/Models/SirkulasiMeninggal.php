<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SirkulasiMeninggal extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sirkulasi_meninggal';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'tgl_meninggal',
        'sebab',
        'user_id',
        'penduduk_id'

    ];

    public function penduduk(){
        return $this->belongsTo(Penduduk::class,'penduduk_id','id');
    }


    
}
