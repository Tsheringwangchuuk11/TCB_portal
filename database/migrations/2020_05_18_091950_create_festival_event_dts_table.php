<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFestivalEventDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_festival_event_dtls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 250)->nullable();
            $table->string('title_name', 250)->nullable();
            $table->year('financial_year')->nullable();
            $table->string('location', 250)->nullable();
            $table->date('dates')->nullable();
            $table->string('address', 250)->nullable();
            $table->string('contact_no', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_festival_event_dtls');
    }
}
