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
            $table->string("nama");
            $table->string("tmpt_lahir");
            $table->date("tgl_lahir");
            $table->string("jenis_kelamin");
            $table->string("NKK_keluarga");
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
        Schema::dropIfExists('sirkulasi_melahirkans');
    }
};
