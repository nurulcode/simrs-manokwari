<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterTindakanPemeriksaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('master')->create('tindakan_pemeriksaans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')
                  ->unsigned()
                  ->nullable();
            $table->string('kode')
                  ->unique();
            $table->string('uraian');
            $table->tinyInteger('jenis')
                  ->unsigned();
            $table->timestamps();

            $table->foreign('parent_id')
                  ->references('id')
                  ->on('tindakan_pemeriksaans')
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
        Schema::connection('master')->dropIfExists('tindakan_pemeriksaans');
    }
}
