<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTRoomDtlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_room_dtls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tourist_standard_id')->nullable()->index();
            $table->unsignedBigInteger('room_type_id')->nullable();
            $table->string('room_no')->nullable();

            $table->timestamps();
            $table->foreign('tourist_standard_id')->references('id')->on('t_tourist_standard_dtls');
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
        Schema::dropIfExists('t_room_dtls');
    }
}
