<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTTransportApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_transport_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('application_no')->nullable()->index();
            $table->unsignedBigInteger('vehicle_id')->nullable()->index();
            $table->boolean('transport_status')->default(0);
            $table->boolean('fitness')->default(0);

            $table->foreign('application_no')->references('application_no')->on('t_applications');
            $table->foreign('vehicle_id')->references('id')->on('t_vehicles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_transport_applications');
    }
}
