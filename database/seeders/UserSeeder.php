<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $created_at = date("Y-m-d H:i:s", strtotime(Date::now()));
        $user = User::firstOrCreate([
            'email' => 'james@gmail.com',
        ], [
            'nama' => 'james',
            'email' => 'james@gmail.com',
            'email_verified_at'=>$created_at,
            'password' => Hash::make('123'),
            'created_at' => $created_at,
            'updated_at' => $created_at,

        ]);
        
    }
}
