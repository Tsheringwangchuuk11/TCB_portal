<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTSystemSubMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_system_sub_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('system_menu_id')->index()->nullable();
            $table->unsignedBigInteger('service_id')->index()->nullable();
            $table->string('name');
            $table->string('route');
            $table->unsignedInteger('display_order');
            $table->timestamps();
            $table->foreign('system_menu_id')->references('id')->on('t_system_menus');
            $table->foreign('service_id')->references('id')->on('t_services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_system_sub_menus');
    }
}
