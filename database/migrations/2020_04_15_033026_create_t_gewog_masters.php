<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTGewogMasters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_gewog_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('gewog_name');
            $table->unsignedBigInteger('dzongkhag_id');
            $table->foreign('dzongkhag_id')->references('id')->on('t_dzongkhag_masters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_gewog_masters');
    }
}
