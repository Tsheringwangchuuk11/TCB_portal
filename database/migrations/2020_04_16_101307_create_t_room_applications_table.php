<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTRoomApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_room_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('application_no',20)->nullable();
            $table->unsignedBigInteger('room_type_id')->nullable();
            $table->string('room_no')->nullable();
            $table->foreign('application_no')->references('application_no')->on('t_applications');
            $table->foreign('room_type_id')->references('id')->on('t_room_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_room_applications');
    }
}
