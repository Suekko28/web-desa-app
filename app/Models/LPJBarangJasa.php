<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class LPJBarangJasa extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lpj-barang-jasa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'no_pesanan_brg',
        'no_berita_acara',
        'no_berita_acara_pemeriksaan',
        'dana_desa',
        'nama_pelaksana_kegiatan',
        'sk_tpk',
        'nama_rincian_spp',
        'uraian_kwitansi',
        'tgl_pesanan',
        'tgl_bast',
        'jatuh_tempo',
        'jatuh_pemeriksaan',
        'keterangan',
        'nama_toko',
        'pemilik_toko',
        'lampiran',
        'timpemeriksa_id',
        'perihal',
        'alamat',
        'user_id',

    ];
    public function LPJBelanja(): HasMany
    {
        return $this->hasMany(LPJBelanja::class, 'id_barang_jasa', 'id');
    }

    public function TimPemeriksa(): BelongsTo
    {
        return $this->belongsTo(LPJTimPemeriksa::class, 'timpemeriksa_id', 'id');
    }




}
