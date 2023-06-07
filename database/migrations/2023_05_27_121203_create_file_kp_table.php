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
        Schema::create('file_kp', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kp')->unique();
            $table->string('kp_cover')->nullable();
            $table->string('kp_abstrak')->nullable();

            $table->foreign('id')->references('id')->on('kp')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_kp');
    }
};
