<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKepegawaianTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jabatans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uraian');
            $table->timestamps();
        });

        Schema::create('kategori_kualifikasis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode')->unique();
            $table->string('uraian');
            $table->boolean('tenaga_medis')->default(false);
            $table->timestamps();
        });

        Schema::create('kualifikasis', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kualifikasis');

        Schema::dropIfExists('kategori_kualifikasis');

        Schema::dropIfExists('jabatans');
    }
}
