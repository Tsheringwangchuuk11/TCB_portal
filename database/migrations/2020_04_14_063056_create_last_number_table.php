<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLastNumberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_application_last_serial_number', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('last_application_no');
            $table->unsignedBigInteger('service_id')->index();

            $table->foreign('service_id')->references('id')->on('t_services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_application_last_serial_number');
    }
}
