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
        Schema::create('sirkulasi_melahirkans', function (Blueprint $table) {
            $table->id();
            $table->string("nama", 50);
            $table->string("tmpt_lahir", 25);
            $table->date("tgl_lahir");
            $table->integer("jenis_kelamin");
            // $table->string("NKK_keluarga");
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('penduduk_id');
            $table->foreign('penduduk_id')->references('id')->on('penduduk')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sirkulasi_melahirkans');
    }
};
