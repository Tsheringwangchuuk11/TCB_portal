<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTChiwogMasters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_chiwog_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('gewog_id');
            $table->string('chiwog_name');
            $table->string('chiwog_dzo')->nullable();
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
        Schema::dropIfExists('t_chiwog_masters');
    }
}
