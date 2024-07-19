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
        Schema::create('lpj_timpemeriksa', function (Blueprint $table) {
            $table->id();
            $table->string('NIP');
            $table->string('nama');
            $table->string('jabatan');
            $table->date('tgl_pemeriksa');
            $table->string('nomor');
            $table->string('tahun');
            $table->string('alamat');
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
        Schema::dropIfExists('lpj_timpemeriksa');
    }
};
