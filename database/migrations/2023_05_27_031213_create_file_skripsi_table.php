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
        Schema::create('file_skripsi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kode_skripsi');
            $table->string('ta_cover')->nullable();
            $table->text('ta_abstrak')->nullable();
            $table->string('file')->nullable();

            $table->foreign('id')->references('id')->on('skripsi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_skripsi');
    }
};
