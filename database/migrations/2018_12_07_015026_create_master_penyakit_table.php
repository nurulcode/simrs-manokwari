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
            $table->string('kode')->uniquie();
            $table->string('icd')->uniquie();
            $table->string('uraian');
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
        Schema::connection('master')->dropIfExists('kelompok_penyakits');

        Schema::connection('master')->dropIfExists('klasifikasi_penyakits');
    }
}
