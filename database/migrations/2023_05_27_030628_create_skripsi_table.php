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
        Schema::create('skripsi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kode_skripsi')->unique();
            $table->string('nim', 15);
            $table->string('nama_penulis');
            $table->string('judul_skripsi');
            $table->string('tahun_lulus');
            $table->bigInteger('pembimbing1');
            $table->bigInteger('pembimbing2');
            $table->bigInteger('penguji1');
            $table->bigInteger('penguji2');
            $table->bigInteger('penguji3');
            $table->string('peminatan');
            $table->string('lokasi');

            $table->unique(['nim', 'pembimbing1']);
            $table->unique(['nim', 'pembimbing2']);
            $table->unique(['nim', 'penguji1']);
            $table->unique(['nim', 'penguji2']);
            $table->unique(['nim', 'penguji3']);

            $table->foreign('pembimbing1')->references('nip')->on('dosen');
            $table->foreign('pembimbing2')->references('nip')->on('dosen');
            $table->foreign('penguji1')->references('nip')->on('dosen');
            $table->foreign('penguji2')->references('nip')->on('dosen');
            $table->foreign('penguji3')->references('nip')->on('dosen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skripsi');
    }
};
