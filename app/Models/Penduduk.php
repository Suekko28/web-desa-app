<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasOne;



class penduduk extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'penduduk';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tgl_pindah_masuk',
        'tgl_lapor',
        'NIK',
        'NKK',
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'usia',
        'jenis_kelamin',
        'agama',
        'kewarganegaraan',
        'status_pernikahan',
        'dusun',
        'rt',
        'rw',
        'alamat',
        'pendidikan',
        'pekerjaan',
        'kepemilikan_bpjs',
        'kepemilikan_e_ktp',
        'nama_ibu',
        'nama_ayah',
    ];

    public function anak(): HasMany{
        return $this->hasMany(Anak::class, 'NKK_keluarga','NKK');
    }

    public function sirkulasiMeninggal(): HasOne{
        return $this->hasOne(SirkulasiMeninggal::class,'NIK_penduduk','NIK');
    }      

    public function sirkulasiPindah(): HasOne{
        return $this->hasOne(SirkulasiPindah::class,'NIK','NIK');
    }

    public function getAgamaAttribute($value)
    {
        $arr=['islam','kristen protestan','kristen katholik','hindu','buddha','khonghucu'];
        return $arr[$value-1];
    }

    public function getJenisKelaminAttribute($value)
    {
        $arr=['laki-laki','perempuan'];
        return $arr[$value-1];
    }

    public function getKewarganegaraanAttribute($value)
    {
        $arr=['WNI','WNA','Kedua Kewarganegaraan'];
        return $arr[$value-1];
    }
    
    public function getStatusPernikahanAttribute($value)
    {
        $arr=['belum kawin','kawin','cerai hidup','cerai mati'];
        return $arr[$value-1];
    }

    public function getPendidikanAttribute($value)
    {
        $arr=['Belum Sekolah','Tamat SD','Belum Tamat SD','Akademi','SD Sederajat','SLTP Sederajat','SLTA Sederajat','Diploma 1','Diploma 2','Diploma 3','Diploma 4','Stara 1','Stara 2','Stara 3'];
        return $arr[$value-1];
    }
    public function getKepemilikanBpjsAttribute($value)
    {
        $arr=['PPU','PBPU','PD Pemda','Bukan pekerja','PBI JK','Tidak ada'];
        return $arr[$value-1];
    }

    public function getKepemilikanEKtpAttribute($value)
    {
        $arr=['ada','tidak ada'];
        return $arr[$value-1];
    }

    public function getPekerjaanAttribute($value){
        $arr=["Buruh Harian Lepas","Belum Bekerja","Pengrajin Logam","Wiraswasta","Guru","Mengurus Rumah Tangga","Pegawai Negri Sipil","Tentara Nasional Indonesia","Guru ngaji","Wirausaha","Penjahit","Pensiun PNS","Pemulung","Buruh","Linmas wilayah","Driver","Petani","Amil","Service"];
        return $arr[$value-1];
    }
}
