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
        Schema::create('sirkulasi_pendatang', function (Blueprint $table) {
            $table->id();
            $table->string('NIK');
            $table->string('nama');
            $table->integer('jenis_kelamin');
            $table->date('tgl_datang');
            $table->string('alamat_sblm');
            $table->string('alamat_skrg');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sirkulasi_pendatang');
    }
};
