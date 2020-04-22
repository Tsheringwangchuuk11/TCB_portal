<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTTourOperatorPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_tour_operator_partners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('application_no')->index();
            $table->string('partner_name')->nullable();
            $table->bigInteger('partner_cid_no')->nullable();
            $table->date('partner_date_of_birth')->nullable();
            $table->date('partner_gender')->nullable();
            $table->bigInteger('partner_building_no')->nullable();
            $table->bigInteger('partner_flat_no')->nullable();
            $table->bigInteger('partner_village')->nullable();
            $table->bigInteger('partner_location')->nullable();
            $table->foreign('application_no')->references('application_no')->on('t_applications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_tour_operator_partners');
    }
}
