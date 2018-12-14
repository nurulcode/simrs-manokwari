<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('tanggal_registrasi');
            $table->string('no_rekam_medis')->unique()->nullable();
            $table->unsignedInteger('jenis_identitas_id');
            $table->string('nomor_identitas');
            $table->string('nama');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->char('jenis_kelamin', 1)->nullable();
            $table->unsignedTinyInteger('golongan_darah')->nullable();

            $table->unsignedInteger('agama_id')->nullable();
            $table->unsignedInteger('suku_id')->nullable();
            $table->unsignedInteger('pendidikan_id')->nullable();
            $table->unsignedInteger('pekerjaan_id')->nullable();

            $table->string('alamat')->nullable();
            $table->unsignedBigInteger('kelurahan_id')->nullable();
            $table->string('telepon')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->unsignedTinyInteger('status_pernikahan')->nullable();
            $table->string('nama_pasangan')->nullable();
            $table->string('alamat_keluarga')->nullable();
            $table->string('telepon_keluarga')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('jenis_identitas_id')
                ->references('id')
                ->on('jenis_identitas')
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
        Schema::dropIfExists('pasiens');
    }
}
