<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFasilitasTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polikliniks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode')->unique();
            $table->string('nama');
            $table->unsignedInteger('jenis_id');
            $table->timestamps();
        });

        Schema::create('ruangans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('poliklinik_id');
            $table->string('kode')->unique();
            $table->string('nama');
            $table->unsignedTinyInteger('jenis');
            $table->unsignedTinyInteger('kelas');
            $table->timestamps();

            $table->foreign('poliklinik_id')
                ->references('id')
                ->on('polikliniks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ruangans');

        Schema::dropIfExists('polikliniks');
    }
}
