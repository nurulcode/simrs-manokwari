<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogistiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logistiks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uraian');
            $table->string('satuan');
            $table->unsignedInteger('jenis_id');
            $table->unsignedTinyInteger('golongan')->nullable();
            $table->integer('harga_jual')->default(0);
            $table->timestamps();

            $table->foreign('jenis_id')
                ->references('id')
                ->on('jenis_logistiks')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logistiks');
    }
}
