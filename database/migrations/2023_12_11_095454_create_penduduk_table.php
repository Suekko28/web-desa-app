<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penduduk', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_pindah_masuk');
            $table->date('tgl_lapor');
            $table->string('NIK', 100);
            $table->string('NKK', 100);
            $table->string('nama', 100);
            $table->string('tempat_lahir', 100);
            $table->date('tgl_lahir');
            $table->integer('usia');
            $table->integer('jenis_kelamin'); // laki-laki,perempuan
            $table->integer('agama'); //islam,kristen protestan,kristen katholik,hindu,budha,konghucu
            $table->integer('kewarganegaraan'); //WNI,WNA,Kedua Kewarganegaraan
            $table->integer('status_pernikahan'); //belum kawin,kawin,cerai hidup,cerai mati
            $table->string('dusun' , 100);
            $table->string('rt', 10);
            $table->string('rw', 10);
            $table->string('alamat');
            $table->integer('pendidikan'); //tidak sekolah,SD,SLTP,SLTA,diploma 1,diploma 2,diploma 3,diploma 4
            $table->integer('pekerjaan');
            $table->integer('kepemilikan_bpjs');
            $table->integer('kepemilikan_e_ktp');
            $table->string('nama_ibu', 100);
            $table->string('nama_ayah', 100);
            $table->unsignedBigInteger('user_id')->default(1);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk');
    }
};
