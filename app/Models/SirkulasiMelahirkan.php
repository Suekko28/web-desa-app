<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SirkulasiMelahirkan extends Model
{
    use HasFactory;

    protected $table = 'sirkulasi_melahirkans';

    protected $fillable = [
        'nama',
        'tmpt_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'NKK_keluarga',
        'user_id',
    ];

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'NKK_keluarga', 'NKK');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
