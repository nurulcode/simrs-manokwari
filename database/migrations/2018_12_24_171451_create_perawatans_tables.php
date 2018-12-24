<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerawatansTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perawatans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kunjungan_id');
            $table->unsignedInteger('perawatan_id');
            $table->string('perawatan_type');
            $table->timestamps();

            $table->foreign('kunjungan_id')
                ->references('id')
                ->on('kunjungans')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::create('rawat_jalans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kunjungan_id');
            $table->datetime('waktu_kunjungan');
            $table->datetime('waktu_keluar')->nullable();
            $table->unsignedTinyInteger('kondisi_akhir')->nullable();
            $table->unsignedInteger('jenis_registrasi_id');
            $table->unsignedInteger('kegiatan_id');
            $table->unsignedInteger('poliklinik_id');
            $table->timestamps();

            $table->foreign('kunjungan_id')
                ->references('id')
                ->on('kunjungans')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('jenis_registrasi_id')
                ->references('id')
                ->on('jenis_registrasis')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('kegiatan_id')
                ->references('id')
                ->on('kegiatans')
                ->onUpdate('cascade')
                ->onDelete('restrict');
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
        Schema::dropIfExists('rawat_jalans');

        Schema::dropIfExists('perawatans');
    }
}