<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'NIK_penduduk',
        'tgl_meninggal',
        'sebab',
    ];

    public function penduduk(){
        return $this->belongsTo(Penduduk::class,'NIK_penduduk','NIK');
    }
    
}
