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
        Schema::create('pemerintahan_rt', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('jabatan', 100);
            $table->string('tmpt_lahir', 100);
            $table->integer('jenis_kelamin');
            $table->date('tgl_lahir');
            $table->text('alamat');
            $table->string('profile');
            $table->string('no_telepon', 100);
            $table->string('no_sk', 100);
            $table->date('tgl_sk');
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
        Schema::dropIfExists('pemerintahan_rt');
    }
};
