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
            $table->unsignedInteger('jenis_registrasi_id');
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
        });

        Schema::create('pelayanans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kunjungan_id');
            $table->unsignedInteger('layanan_id');
            $table->string('layanan_type');
            $table->timestamps();
        });

        Schema::create('rawat_jalans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kegiatan_id');
            $table->unsignedInteger('poliklinik_id');
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
        Schema::dropIfExists('rawat_jalans');

        Schema::dropIfExists('pelayanans');

        Schema::dropIfExists('kunjungans');
    }
}
