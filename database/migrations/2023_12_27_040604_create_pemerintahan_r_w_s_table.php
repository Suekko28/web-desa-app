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
        Schema::create('pemerintahan_rw', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->string('jabatan', 25);
            $table->string('tmpt_lahir', 25);
            $table->integer('jenis_kelamin');
            $table->date('tgl_lahir');
            $table->text('alamat');
            $table->string('profile');
            $table->string('no_telepon', 25);
            $table->string('no_sk', 25);
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
        Schema::dropIfExists('pemerintahan_rw');
    }
};
