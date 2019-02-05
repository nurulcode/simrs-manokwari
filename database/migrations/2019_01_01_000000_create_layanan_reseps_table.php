<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLayananResepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layanan_reseps', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('perawatan_id');
            $table->string('perawatan_type');
            $table->unsignedInteger('obat_id');
            $table->unsignedInteger('jumlah')->default(1);
            $table->string('aturan_pakai');
            $table->dateTime('waktu');
            $table->unsignedInteger('petugas_id');
            $table->timestamps();

            $table->foreign('petugas_id')
                ->references('id')
                ->on('pegawais')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('obat_id')
                ->references('id')
                ->on('logistiks')
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
        Schema::dropIfExists('reseps');
    }
}
