<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogistiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logistiks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uraian');
            $table->string('satuan');
            $table->unsignedInteger('jenis_id');
            $table->unsignedTinyInteger('golongan')->nullable();
            $table->integer('harga_jual')->default(0);
            $table->timestamps();

            $table->foreign('jenis_id')
                ->references('id')
                ->on('jenis_logistiks')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::create('supliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->text('alamat');
            $table->string('no_telepon');
            $table->timestamps();
        });

        Schema::create('penerimaans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('suplier_id');
            $table->unsignedTinyInteger('sistem_pembayaran');
            $table->string('no_faktur')->unique();
            $table->date('tanggal_faktur');
            $table->date('jatuh_tempo');
            $table->date('tanggal_terima');
            $table->timestamps();

            $table->foreign('suplier_id')
                ->references('id')
                ->on('supliers')
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
        Schema::dropIfExists('penerimaans');

        Schema::dropIfExists('supliers');

        Schema::dropIfExists('logistiks');
    }
}
