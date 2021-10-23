<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sensor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensor', function (Blueprint $table) {
            $table->bigIncrements('id_sensor');
            $table->bigInteger('id_kandang')->unsigned();
            $table->bigInteger('id_device')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_kandang')->references('id_kandang')->on('kandang');
            $table->foreign('id_device')->references('id_device')->on('device');
            $table->unique(array('id_device'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensor');
    }
}
