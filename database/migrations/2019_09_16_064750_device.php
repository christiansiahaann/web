<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Device extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device', function (Blueprint $table) {
            $table->bigIncrements('id_device');
            $table->bigInteger('id_ref_sensor')->unsigned();
            $table->string('key');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_ref_sensor')->references('id_ref_sensor')->on('ref_sensor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('device');
    }
}
