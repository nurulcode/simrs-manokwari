<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterPenyakitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('master')->create('klasifikasi_penyakits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode')->unique();
            $table->string('uraian');
            $table->timestamps();
        });

        Schema::connection('master')->create('kelompok_penyakits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('klasifikasi_id')
                  ->unsigned()
                  ->nullable();
            $table->string('kode')->unique();
            $table->string('icd')->unique();
            $table->string('uraian');
            $table->timestamps();

            $table->foreign('klasifikasi_id')
                ->references('id')
                ->on('klasifikasi_penyakits')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::connection('master')->create('penyakits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kelompok_id')
                  ->unsigned()
                  ->nullable();
            $table->string('icd')->unique();
            $table->string('uraian');
            $table->timestamps();

            $table->foreign('kelompok_id')
                ->references('id')
                ->on('kelompok_penyakits')
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
        Schema::connection('master')->dropIfExists('penyakits');

        Schema::connection('master')->dropIfExists('kelompok_penyakits');

        Schema::connection('master')->dropIfExists('klasifikasi_penyakits');
    }
}
