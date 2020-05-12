<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTChannelApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_channel_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('application_no')->index();
            $table->unsignedBigInteger('channel_type_id')->index()->nullable();
            $table->string('channel_name')->nullable();
            $table->string('circulation')->nullable();
            $table->string('target_audience')->nullable();

            $table->foreign('application_no')->references('application_no')->on('t_applications');
            $table->foreign('channel_type_id')->references('id')->on('t_channel_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_channel_applications');
    }
}
