<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTRoomDtlsAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_room_dtls_audit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('room_dtls_id')->index();
            $table->unsignedBigInteger('tourist_standard_id')->nullable()->index();
            $table->unsignedBigInteger('room_type_id')->nullable();
            $table->string('room_no')->nullable();
            $table->timestamps();
            $table->foreign('room_dtls_id')->references('id')->on('t_room_dtls');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_room_dtls_audit');
    }
}
