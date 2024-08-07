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
        Schema::create('lpj-barang-jasa', function (Blueprint $table) {
            $table->id();
            $table->string("no_pesanan_brg", 50);
            $table->string("no_berita_acara", 50);
            $table->string("no_berita_acara_pemeriksaan", 50);
            $table->string("dana_desa", 50);
            $table->string("nama_pelaksana_kegiatan", 50);
            $table->string("sk_tpk" , 50);
            $table->string("nama_rincian_spp", 50);
            $table->string("uraian_kwitansi", 50);
            $table->date('tgl_pesanan');
            $table->date('tgl_bast');
            $table->date('jatuh_tempo');
            $table->date('jatuh_pemeriksaan');
            $table->text('keterangan');
            $table->string('nama_toko', 50);
            $table->string('pemilik_toko', 25);
            $table->string('lampiran', 50);
            $table->string('perihal', 50);
            $table->text('alamat');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('timpemeriksa_id');
            $table->foreign('timpemeriksa_id')->references('id')->on('lpj_timpemeriksa')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lpj-barang-jasa');
    }
};
