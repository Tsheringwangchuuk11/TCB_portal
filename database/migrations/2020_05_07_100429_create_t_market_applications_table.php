<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTMarketApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_market_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('application_no')->index();
            $table->unsignedBigInteger('country_id')->index()->nullable();
            $table->string('city')->nullable();

            $table->foreign('application_no')->references('application_no')->on('t_applications');
            $table->foreign('country_id')->references('id')->on('t_country_masters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_market_applications');
    }
}
