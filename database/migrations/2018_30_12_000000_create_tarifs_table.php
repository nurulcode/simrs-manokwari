<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTarifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarifs', function (Blueprint $table) {
            $table->string('tarifable_type');
            $table->unsignedInteger('tarifable_id');
            $table->json('data');
            $table->timestamps();

            $table->primary(['tarifable_type', 'tarifable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarifs');
    }
}
