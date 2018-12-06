<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterWilayahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('master')->create('provinsis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::connection('master')->create('kota_kabupatens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provinsi_id')->unsigned();
            $table->string('name');
            $table->timestamps();

            $table->foreign('provinsi_id')
                  ->references('id')
                  ->on('provinsis')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });

        Schema::connection('master')->create('kecamatans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kota_kabupaten_id')->unsigned();
            $table->string('name');
            $table->timestamps();

            $table->foreign('kota_kabupaten_id')
                  ->references('id')
                  ->on('kota_kabupatens')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });

        Schema::connection('master')->create('kelurahans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('kecamatan_id')->unsigned();
            $table->string('name');
            $table->timestamps();

            $table->foreign('kecamatan_id')
                  ->references('id')
                  ->on('kecamatans')
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
        Schema::connection('master')->dropIfExists('kelurahans');

        Schema::connection('master')->dropIfExists('kecamatans');

        Schema::connection('master')->dropIfExists('kota_kabupatens');

        Schema::connection('master')->dropIfExists('provinsis');
    }
}
