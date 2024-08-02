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
        // Schema::dropIfExists('lpj-belanja');
        Schema::create('lpj-belanja', function (Blueprint $table) {
            $table->id();
            $table->integer('id_barang_jasa');
            $table->string('nama_barang', 50);
            $table->integer('volume_qty');
            $table->string('satuan', 25);
            $table->integer('harga');
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
        Schema::dropIfExists('lpj-belanja');
    }
};
