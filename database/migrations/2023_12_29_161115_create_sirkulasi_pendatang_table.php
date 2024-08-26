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
            $table->string('NIK', 25)->unique();
            $table->string('nama', 50);
            $table->integer('jenis_kelamin');
            $table->date('tgl_datang');
            $table->text('alamat_sblm');
            $table->text('alamat_skrg');
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
