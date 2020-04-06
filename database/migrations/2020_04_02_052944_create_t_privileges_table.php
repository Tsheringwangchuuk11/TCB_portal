<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_privileges', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->unsignedBigInteger('role_id')->index();
            $table->unsignedBigInteger('system_sub_menu_id')->index();
            $table->integer('view')->default(0);
            $table->integer('create')->default(0);
            $table->integer('edit')->default(0);
            $table->integer('delete')->default(0);
            $table->unsignedBigInteger('created_by')->index();
            $table->unsignedBigInteger('updated_by')->index()->nullable();
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('t_roles');
            $table->foreign('system_sub_menu_id')->references('id')->on('t_system_sub_menus');
            $table->foreign('created_by')->references('id')->on('t_users');
            $table->foreign('updated_by')->references('id')->on('t_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_privileges');
    }
}
