<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemerintahan_sahbandar', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('tmpt_lahir');
            $table->integer('jenis_kelamin');
            $table->date('tgl_lahir');
            $table->string('alamat');
            $table->string('profile');
            $table->string('no_telepon');
            $table->string('no_sk');
            $table->date('tgl_sk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemerintahan_sahbandar');
    }
};
