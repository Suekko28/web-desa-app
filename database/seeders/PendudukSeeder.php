<?php

namespace Database\Seeders;

// use Carbon\Traits\Date;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $int_date1= mt_rand(1262055681,1362055681);
        $string_date1 = date("Y-m-d",$int_date1);
        $int2= mt_rand(1262055681,1362055681);
        $string_date2 = date("Y-m-d",$int2);
        $int3= mt_rand(1162055681,1222055681);
        $string_date3 = date("Y-m-d H:i:s",$int3);
        $created_at = date("Y-m-d H:i:s", strtotime(Date::now()));

        DB::table('penduduk')->insert([
            'tgl_pindah_masuk'=>$string_date1,
            'tgl_lapor'=>$string_date2,
            'NIK'=>Str::random(16),
            'NKK'=>Str::random(16),
            'nama' => Str::random(mt_rand(10,20)),
            'usia' => mt_rand(1,99),
            'tempat_lahir'=>Str::random(10),
            'tgl_lahir'=>$string_date3,
            'jenis_kelamin'=>mt_rand(1,2),
            'agama'=>mt_rand(1,6),
            'kewarganegaraan'=>mt_rand(1,3),
            'status_pernikahan'=>mt_rand(1,4),
            'dusun'=>mt_rand(1,3),
            'rt'=>Str::random(3),
            'rw'=>Str::random(3),
            'alamat'=>Str::random(mt_rand(10,20)),
            'pendidikan'=>mt_rand(1,11),
            'pekerjaan'=>mt_rand(1,5),
            'kepemilikan_bpjs'=>mt_rand(1,6),
            'kepemilikan_e_ktp'=>mt_rand(1,2),
            'nama_ibu'=>Str::random(10),
            'nama_ayah'=>Str::random(20),
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ]);
    }
}
