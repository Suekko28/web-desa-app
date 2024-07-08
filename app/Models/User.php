<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function pemerintahanDesa() : HasMany {
        return $this->hasMany(PemerintahanDesa::class, 'user_id', 'id');
    }

    public function pemerintahanBPD() : HasMany {
        return $this->hasMany(PemerintahanBPD::class, 'user_id', 'id');
    }

    public function pemerintahanLPM() : HasMany {
        return $this->hasMany(PemerintahanLPM::class, 'user_id', 'id');
    }

    public function pemerintahanMUI() : HasMany {
        return $this->hasMany(PemerintahanMUI::class, 'user_id', 'id');
    }

    public function pemerintahanPKK() : HasMany {
        return $this->hasMany(PemerintahanPKK::class, 'user_id', 'id');
    }
    public function pemerintahanSahbandar() : HasMany {
        return $this->hasMany(PemerintahanSahbandar::class, 'user_id', 'id');
    }
    public function pemerintahanKarangTaruna() : HasMany {
        return $this->hasMany(PemerintahanKarangTaruna::class, 'user_id', 'id');
    }
    public function pemerintahanPosyandu() : HasMany {
        return $this->hasMany(PemerintahanPosyandu::class, 'user_id', 'id');
    }
    public function pemerintahanRT() : HasMany {
        return $this->hasMany(PemerintahanRT::class, 'user_id', 'id');
    }
    public function pemerintahanRW() : HasMany {
        return $this->hasMany(PemerintahanRW::class, 'user_id', 'id');
    }
    public function pemerintahanKadus() : HasMany {
        return $this->hasMany(PemerintahanKadus::class, 'user_id', 'id');
    }

    public function penduduk() : HasMany {
        return $this->hasMany(penduduk::class, 'user_id', 'id');
    }

    public function sirkulasiMelahirkan() : HasMany {
        return $this->hasMany(Anak::class, 'user_id', 'id');
    }

    public function sirkulasiMeninggal() : HasMany {
        return $this->hasMany(SirkulasiMeninggal::class, 'user_id', 'id');
    }
    public function sirkulasiPendatang() : HasMany {
        return $this->hasMany(SirkulasiPendatang::class, 'user_id', 'id');
    }

    public function sirkulasiPindah() : HasMany {
        return $this->hasMany(SirkulasiPindah::class, 'user_id', 'id');
    }

    public function timPemeriksa() : HasMany {
        return $this->hasMany(LPJTimPemeriksa::class, 'user_id', 'id');
    }

    public function LPJBarangJasa() : HasMany {
        return $this->hasMany(LPJBarangJasa::class, 'user_id', 'id');
    }


}
