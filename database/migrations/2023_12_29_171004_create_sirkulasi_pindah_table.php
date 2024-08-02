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
        Schema::create('sirkulasi_pindah', function (Blueprint $table) {
            $table->id();
            $table->string('NIK');
            $table->string('nama_penduduk', 50)->nullable();
            $table->date('tgl_pindah');
            $table->text('alasan');
            $table->text('alamat_pindah');
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
        Schema::dropIfExists('sirkulasi_pindah');
    }
};
