<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKunjunganTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tarif_registrasi_id')->nullable();
            $table->datetime('waktu_kunjungan');
            $table->string('nomor_kunjungan')->nullable();
            $table->unsignedBigInteger('pasien_id');
            $table->boolean('pasien_baru')->default(false);
            $table->unsignedInteger('kasus_id')->nullable();
            $table->unsignedInteger('penyakit_id')->nullable();
            $table->string('keluhan');
            $table->unsignedInteger('jenis_rujukan_id')->nullable();
            $table->string('rujukan_asal')->nullable();
            $table->string('rujukan_nomor')->nullable();
            $table->date('rujukan_tanggal')->nullable();
            $table->string('pj_nama')->nullable();
            $table->string('pj_telepon')->nullable();
            $table->unsignedInteger('cara_pembayaran_id')->nullable();
            $table->string('sjp_nomor')->nullable();
            $table->date('sjp_tanggal')->nullable();
            $table->timestamps();

            $table->foreign('tarif_registrasi_id')
                ->references('id')
                ->on('tarif_registrasis')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('pasien_id')
                ->references('id')
                ->on('pasiens')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('kasus_id')
                ->references('id')
                ->on('kasuses')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('penyakit_id')
                ->references('id')
                ->on('penyakits')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('jenis_rujukan_id')
                ->references('id')
                ->on('jenis_rujukans')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('cara_pembayaran_id')
                ->references('id')
                ->on('cara_pembayarans')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });

        Schema::create('pelayanans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kunjungan_id');
            $table->unsignedInteger('layanan_id');
            $table->string('layanan_type');
            $table->timestamps();

            $table->foreign('kunjungan_id')
                ->references('id')
                ->on('kunjungans')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::create('rawat_jalans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tarif_registrasi_id');
            $table->unsignedInteger('kegiatan_id');
            $table->unsignedInteger('poliklinik_id');
            $table->timestamps();

            $table->foreign('tarif_registrasi_id')
                ->references('id')
                ->on('tarif_registrasis')
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

        Schema::dropIfExists('pelayanans');

        Schema::dropIfExists('kunjungans');
    }
}
