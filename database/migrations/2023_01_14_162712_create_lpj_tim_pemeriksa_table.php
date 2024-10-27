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
            $table->string('NIP', 100);
            $table->string('nama', 100);
            $table->string('jabatan', 100);
            $table->date('tgl_pemeriksa');
            $table->string('nomor', 100);
            $table->string('tahun', 100);
            $table->text('alamat');
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
