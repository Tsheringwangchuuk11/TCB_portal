<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTStaffApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_staff_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('application_no')->nullable()->index();
            $table->unsignedBigInteger('staff_area_id')->nullable()->index();
            $table->unsignedBigInteger('hotel_div_id')->nullable()->index();
            $table->string('staff_name')->nullable();
            $table->char('staff_gender',1)->nullable();
            $table->foreign('application_no')->references('application_no')->on('t_applications');
            $table->foreign('staff_area_id')->references('id')->on('t_staff_areas');
            $table->foreign('hotel_div_id')->references('id')->on('t_hotel_divisions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_staff_applications');
    }
}
