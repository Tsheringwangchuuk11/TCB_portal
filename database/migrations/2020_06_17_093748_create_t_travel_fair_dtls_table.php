<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTTravelFairDtlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_travel_fair_dtls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('event_id');
            $table->string('name');
            $table->string('cid_no');
            $table->unsignedBigInteger('contact_no');
            $table->string('email');
            $table->string('company_name');
            $table->date('date_of_registration');
            $table->text('remarks');
            $table->foreign('event_id')->references('id')->on('t_event_dtls');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_travel_fair_dtls');
    }
}
