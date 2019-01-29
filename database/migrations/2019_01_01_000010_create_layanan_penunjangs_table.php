<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLayananPenunjangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layanan_penunjangs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('perawatan_id');
            $table->string('perawatan_type');
            $table->unsignedInteger('poliklinik_id');
            $table->dateTime('waktu');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('poliklinik_id')
                ->references('id')
                ->on('polikliniks')
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
        Schema::dropIfExists('layanan_penunjangs');
    }
}
