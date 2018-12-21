<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTarifRegistrasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarif_registrasis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uraian');
            $table->unsignedTinyInteger('kategori');
            $table->integer('tarif_sarana')->default(0);
            $table->integer('tarif_pelayanan')->default(0);
            $table->integer('tarif_bhp')->default(0);
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
        Schema::dropIfExists('tarif_registrasis');
    }
}
