<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kp', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kp')->unique();
            $table->string('judul_kp');
            $table->string('tempat_kp');
            $table->string('tahun');
            $table->string('nim1', 10)->nullable();
            $table->string('mahasiswa1')->nullable();
            $table->string('nim2', 10)->nullable();
            $table->string('mahasiswa2')->nullable();
            $table->string('nim3', 10)->nullable();
            $table->string('mahasiswa3')->nullable();
            $table->string('nim4', 10)->nullable();
            $table->string('mahasiswa4')->nullable();
            $table->string('nim5', 10)->nullable();
            $table->string('mahasiswa5')->nullable();
            $table->bigInteger('pembimbing_jurusan');
            $table->string('pembimbing_lapangan')->nullable();

            $table->foreign('pembimbing_jurusan')->references('nip')->on('dosen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kp');
    }
};
