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
            $table->string("no_pesanan_brg");
            $table->string("no_berita_acara");
            $table->string("nama_pelaksana_kegiatan");
            $table->string("sk_tpk");
            $table->string("nama_rincian_spp");
            $table->string("uraian_kwitansi");
            $table->date('tgl_pesanan');
            $table->date('tgl_bast');
            $table->date('jatuh_tempo');
            $table->date('jatuh_pemeriksaan');
            $table->string('keterangan');
            $table->string('nama_toko');
            $table->string('pemilik_toko');
            $table->string('lampiran');
            $table->integer('tim_pemeriksa');
            $table->string('perihal');
            $table->string('alamat');
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
