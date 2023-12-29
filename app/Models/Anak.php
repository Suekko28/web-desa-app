<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'anak';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'tmpt_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'NKK_keluarga',
    ];

    public function penduduk(){
        return $this->belongsTo(Penduduk::class,'NKK','NKK_keluarga');
    }
}
