<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class LPJTimPemeriksa extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lpj_timpemeriksa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'NIP',
        'nama',
        'jabatan',
        'tgl_pemeriksa',
        'nomor',
        'tahun',
        'alamat',
        'user_id',

    ];
    public function AnggotaLPJTimPemeriksa(): HasMany{
        return $this->hasMany(AnggotaLPJTimPemeriksa::class,'timpemeriksa_id','id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    
    
}
