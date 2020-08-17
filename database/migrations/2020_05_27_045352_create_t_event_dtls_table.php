<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTEventDtlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_event_dtls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event_name', 250)->nullable();
            $table->unsignedBigInteger('country_id')->index()->nullable();
            $table->string('event_location', 250)->nullable();
            $table->string('web_site', 250)->nullable();
            $table->string('contact_person', 250)->nullable();
            $table->string('email', 250)->nullable();
            $table->string('mobile_no', 250)->nullable();
            $table->string('village_id', 250)->nullable();
            $table->date('last_date')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('event_dtls')->nullable();
            $table->unsignedBigInteger('created_by')->index();
            $table->unsignedBigInteger('updated_by')->nullable()->index();
            $table->timestamps();
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
        Schema::dropIfExists('t_event_dtls');
    }
}
