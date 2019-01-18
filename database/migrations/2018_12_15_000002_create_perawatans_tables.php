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
        Schema::create('registrasis', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('jenis_registrasi_id');
            $table->unsignedInteger('kunjungan_id');
            $table->unsignedInteger('perawatan_id')->nullable();
            $table->string('perawatan_type')->nullable();
            $table->json('tarif')->nullable();
            $table->timestamps();

            $table->foreign('jenis_registrasi_id')
                ->references('id')
                ->on('jenis_registrasis')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('kunjungan_id')
                ->references('id')
                ->on('kunjungans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
                ->onDelete('cascade');
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

        Schema::create('rawat_darurats', function (Blueprint $table) {
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
                ->onDelete('cascade');
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

        Schema::create('rawat_inaps', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kunjungan_id');
            $table->datetime('waktu_kunjungan');
            $table->datetime('waktu_keluar')->nullable();
            $table->unsignedTinyInteger('kondisi_akhir')->nullable();
            $table->unsignedInteger('jenis_registrasi_id');
            $table->unsignedInteger('kegiatan_id');
            $table->unsignedInteger('ranjang_id');
            $table->unsignedTinyInteger('cara_penerimaan');
            $table->unsignedTinyInteger('aktifitas');
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
            $table->foreign('ranjang_id')
                ->references('id')
                ->on('ranjangs')
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
        Schema::dropIfExists('rawat_inaps');

        Schema::dropIfExists('rawat_darurats');

        Schema::dropIfExists('rawat_jalans');

        Schema::dropIfExists('registrasis');
    }
}
