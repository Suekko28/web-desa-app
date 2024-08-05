<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SirkulasiPindah extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sirkulasi_pindah';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // 'nama_penduduk',
        'penduduk_id',
        'tgl_pindah',
        'alasan',
        'alamat_pindah',
        'user_id',

    ];

    public function penduduk(){
        return $this->belongsTo(Penduduk::class,'penduduk_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
