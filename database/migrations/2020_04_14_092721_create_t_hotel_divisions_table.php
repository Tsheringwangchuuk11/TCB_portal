<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTHotelDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_hotel_divisions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('staff_area_id');
            $table->string('hotel_div_name');
            $table->foreign('staff_area_id')->references('id')->on('t_staff_areas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_hotel_divisions');
    }
}
