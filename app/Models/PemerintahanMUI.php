<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemerintahanMUI extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pemerintahan_mui';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'jabatan',
        'tmpt_lahir',
        'jenis_kelamin',
        'tgl_lahir',
        'alamat',
        'profile',
        'no_telepon',
        'no_sk',
        'tgl_sk',
    ];
}
