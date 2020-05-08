<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTEquipmentApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_equipment_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('application_no')->nullable()->index();
            $table->unsignedBigInteger('equipment_id')->nullable()->index();
            $table->boolean('equipment_status')->default(0);
            $table->text('equipment_remarks')->nullable();
            $table->foreign('application_no')->references('application_no')->on('t_applications');
            $table->foreign('equipment_id')->references('id')->on('t_equipments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_equipment_applications');
    }
}
