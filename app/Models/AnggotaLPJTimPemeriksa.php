<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class AnggotaLPJTimPemeriksa extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'anggota_lpj_tim_pemeriksa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_ketua',
        'nama',
        'jabatan',
    ];
    public function KetuaLPJTimPemeriksa(): BelongsTo{
        return $this->belongsTo(LPJTimPemeriksa::class,'id_ketua','id');
    }
}
