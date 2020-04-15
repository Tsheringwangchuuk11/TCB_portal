<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTVillageMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_village_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('village_name');
            $table->string('village_name_dzo')->nullable();
            $table->unsignedBigInteger('gewog_id');
            $table->foreign('gewog_id')->references('id')->on('t_gewog_masters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_village_masters');
    }
}
