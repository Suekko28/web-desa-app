<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemerintahanRT extends Model
{
    protected $table = 'pemerintahan_RT';

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
