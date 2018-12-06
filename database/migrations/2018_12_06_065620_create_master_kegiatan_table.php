<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('master')->create('kategori_kegiatans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uraian');
            $table->timestamps();
        });

        Schema::connection('master')->create('kegiatans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')
                  ->unsigned()
                  ->nullable();
            $table->string('uraian');
            $table->timestamps();

            $table->foreign('parent_id')
                  ->references('id')
                  ->on('kegiatans')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('master')->dropIfExists('kegiatans');

        Schema::connection('master')->dropIfExists('kategori_kegiatans');
    }
}
